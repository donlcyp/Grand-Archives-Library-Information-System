<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the user's borrowed books
        $borrowedBooks = BorrowedBook::where('user_id', Auth::id())
            ->with('book')
            ->get();

        // Count overdue books
        $overdueCount = BorrowedBook::where('user_id', Auth::id())
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->count();

        // Fetch trending books (latest 5 books)
        $books = Book::orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        // Add average rating and rating count to each trending book
        foreach ($books as $book) {
            $book->average_rating = \App\Models\Rating::where('book_id', $book->id)->avg('rating') ?? 0;
            $book->rating_count = \App\Models\Rating::where('book_id', $book->id)->count();
        }

        // Fetch top books (based on average rating)
        $topBooks = Book::select('books.*')
            ->leftJoinSub(
                \App\Models\Rating::selectRaw('book_id, AVG(rating) as avg_rating, COUNT(*) as rating_count')
                    ->groupBy('book_id'),
                'rating_stats',
                'books.id',
                '=',
                'rating_stats.book_id'
            )
            ->orderByRaw('CASE WHEN rating_stats.avg_rating IS NULL THEN 1 ELSE 0 END')
            ->orderBy('rating_stats.avg_rating', 'desc')
            ->orderBy('rating_stats.rating_count', 'desc')
            ->take(15)
            ->get();

        // Add average rating and rating count to each top book
        foreach ($topBooks as $book) {
            $book->average_rating = \App\Models\Rating::where('book_id', $book->id)->avg('rating') ?? 0;
            $book->rating_count = \App\Models\Rating::where('book_id', $book->id)->count();
        }

        // Fetch most read books (most borrowed)
        $mostReadBooks = Book::select('books.*')
            ->leftJoinSub(
                BorrowedBook::selectRaw('book_id, COUNT(*) as borrow_count')
                    ->groupBy('book_id'),
                'borrow_counts',
                'books.id',
                '=',
                'borrow_counts.book_id'
            )
            ->orderByRaw('CASE WHEN borrow_counts.borrow_count IS NULL THEN 1 ELSE 0 END')
            ->orderBy('borrow_counts.borrow_count', 'desc')
            ->take(15)
            ->get();

        // Add average rating, rating count, and borrow count to each most read book
        foreach ($mostReadBooks as $book) {
            $book->average_rating = \App\Models\Rating::where('book_id', $book->id)->avg('rating') ?? 0;
            $book->rating_count = \App\Models\Rating::where('book_id', $book->id)->count();
            $book->borrow_count = BorrowedBook::where('book_id', $book->id)->count();
        }

        // Fetch user's average rating and rating count
        $userRatings = \App\Models\Rating::where('user_id', Auth::id());
        $averageRating = $userRatings->avg('rating') ?? 0;
        $ratingCount = $userRatings->count();

        return view('dashboard', compact('borrowedBooks', 'overdueCount', 'books', 'topBooks', 'mostReadBooks', 'averageRating', 'ratingCount'));
    }

    public function borrow(Request $request, Book $book)
    {
        try {
            // Check if the book is in stock
            if ($book->quantity <= 0) {
                return redirect()->route('dashboard')->with('error', 'This book is currently out of stock.');
            }

            // Check if the user has already borrowed this book and not returned it
            $existingBorrow = BorrowedBook::where('user_id', Auth::id())
                ->where('book_id', $book->id)
                ->whereNull('returned_at')
                ->first();

            if ($existingBorrow) {
                return redirect()->route('dashboard')->with('error', 'You have already borrowed this book.');
            }

            // Decrease the book's quantity
            $book->quantity -= 1;
            $book->save();

            // Create a new borrowed book record
            BorrowedBook::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'borrowed_at' => now(),
                'due_date' => now()->addDays(14), // 2-week borrowing period
                'status' => 'borrowed',
                'late_fee' => 0,
            ]);

            return redirect()->route('dashboard')->with('success', 'Book borrowed successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Failed to borrow book: ' . $e->getMessage());
        }
    }
}