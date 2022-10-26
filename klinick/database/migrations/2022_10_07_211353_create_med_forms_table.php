<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMedFormsTable.
 */
class CreateMedFormsTable extends Migration{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){

		Schema::create('med_forms', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');

			$table->date("date");
			$table->string('state', 32);
			$table->string('city', 32);
			$table->string('complaint', 1000);
			$table->string('paymentMode', 32);

			$table->timestamps();

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
		Schema::drop('med_forms');
	}
}
