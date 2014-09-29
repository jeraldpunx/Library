<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('borrowers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('borrower_code');
			$table->string('first_name');
			$table->string('last_name');
			$table->unsignedInteger('user_id')->nullable();
			$table->timestamps();
		});

		Schema::table('borrowers', function(Blueprint $table)
		{
		    $table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('borrowers');
	}

}
