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
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')
							->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('book_id');
			$table->foreign('book_id')->references('id')->on('books')
							->onDelete('cascade')->onUpdate('cascade');
			$table->timestamp('borrewedDate');
			$table->timestamp('returnedDate');
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
