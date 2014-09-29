<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('borrower_id');
			$table->unsignedInteger('book_id');
			$table->timestamp('reservedDate')->nullable();
			$table->timestamp('borrowedDate')->nullable();
			$table->timestamp('returnedDate')->nullable();

		});

		Schema::table('transactions', function(Blueprint $table)
		{
			$table->foreign('borrower_id')->references('id')->on('borrowers')
							->onDelete('cascade')->onUpdate('cascade');
		    $table->foreign('book_id')->references('id')->on('books')
							->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}

}
