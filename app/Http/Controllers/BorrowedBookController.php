<?php

namespace App\Http\Controllers;

use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowedBookController extends Controller
{
    public function returnBook(Request $request, BorrowedBook $borrowedBook)
    {
        // Ensure the authenticated user owns the borrowed book
        if ($borrowedBook->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to return this book.');
        }

        // Update the book status
        $borrowedBook->update([
            'status' => 'returned',
            'returned_at' => now(),
        ]);

        // Increment the book stock quantity
        $book = $borrowedBook->book;
        if ($book) {
            $book->quantity = $book->quantity + 1;
            $book->save();
        }

        // Recalculate late fee (if your logic requires it)
        $lateFee = $this->calculateLateFee($borrowedBook);
        $borrowedBook->update(['late_fee' => $lateFee]);

        return redirect()->route('transaction')->with('success', 'Book marked as returned successfully.');
    }

    private function calculateLateFee(BorrowedBook $borrowedBook)
    {
        // Example: $1 per day late
        if ($borrowedBook->due_date < now() && !$borrowedBook->returned_at) {
            $daysLate = $borrowedBook->due_date->diffInDays(now());
            return $daysLate * 10.00; // Increased late fee by 10 PHP
        }
        return $borrowedBook->late_fee ?? 0;
    }
}
