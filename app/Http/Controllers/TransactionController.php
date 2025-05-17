<?php
// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowedBook;
use App\Models\Transaction;
use App\Models\RecentlyReturnedBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lateFeePerDay = 0.50; // $0.50 per day late

        // Fetch all borrowed books for the user
        $borrowedBooks = BorrowedBook::where('user_id', $user->id)
            ->with('book')
            ->orderBy('borrowed_at', 'desc')
            ->get();

        // Calculate late fees for non-returned, overdue books
        foreach ($borrowedBooks as $borrowedBook) {
            if (!$borrowedBook->returned_at && $borrowedBook->due_date < now()) {
                $daysLate = now()->diffInDays($borrowedBook->due_date);
                $lateFee = $daysLate * $lateFeePerDay;
                $borrowedBook->update(['late_fee' => $lateFee]);
            } elseif (!$borrowedBook->returned_at && $borrowedBook->due_date >= now()) {
                $borrowedBook->update(['late_fee' => 0]);
            }
            // Note: Late fees for returned books are set in AdminController::updateBorrowStatus
        }

        // Refresh borrowed books after updates
        $borrowedBooks = BorrowedBook::where('user_id', $user->id)
            ->with('book')
            ->orderBy('borrowed_at', 'desc')
            ->get();

        // Fetch books that are due (not returned yet and past due date)
        $dueBooks = BorrowedBook::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->with('book')
            ->get();

        // Fetch recently returned books from recently_returned_books table
        $returnedBooks = RecentlyReturnedBook::where('user_id', $user->id)
            ->with('book')
            ->orderBy('returned_at', 'desc')
            ->take(100)
            ->get();

        // Calculate total due amount from late fees including returned books with late fees
        $dueAmount = $borrowedBooks->where('late_fee', '>', 0)->sum('late_fee');

        // Fetch payment history
        $paymentHistory = Transaction::where('user_id', $user->id)
            ->where('type', 'payment')
            ->orderBy('created_at', 'desc')
            ->take(100)
            ->get();

        return view('transactions', compact('borrowedBooks', 'dueBooks', 'returnedBooks', 'dueAmount', 'paymentHistory'));
    }

    public function makePayment(Request $request)
    {
        $request->validate([
            'borrowed_book_id' => 'required|exists:borrowed_books,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $borrowedBook = BorrowedBook::where('id', $request->borrowed_book_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($borrowedBook->late_fee <= 0) {
            return redirect()->back()->with('error', 'No late fee to pay for this book.');
        }

        if ($request->amount < $borrowedBook->late_fee) {
            return redirect()->back()->with('error', 'Payment amount is less than the late fee.');
        }

        // Record the payment transaction
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => 'payment',
            'description' => 'Payment for late fee on book: ' . $borrowedBook->book->title,
        ]);

        // Update the borrowed book status and late fee
        $borrowedBook->update([
            'late_fee' => 0,
            'status' => 'paid',
        ]);

        return redirect()->route('transaction')->with('success', 'Payment successful.');
    }
}