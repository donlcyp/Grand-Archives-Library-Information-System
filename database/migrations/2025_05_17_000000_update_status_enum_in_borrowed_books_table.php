'<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusEnumInBorrowedBooksTable extends Migration
{
    public function up()
    {
        // Modify the 'status' column to include 'paid' as an allowed value
        Schema::table('borrowed_books', function (Blueprint $table) {
            $table->enum('status', ['borrowed', 'returned', 'paid'])->default('borrowed')->change();
        });
    }

    public function down()
    {
        // Revert the 'status' column to original enum values
        Schema::table('borrowed_books', function (Blueprint $table) {
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed')->change();
        });
    }
}
