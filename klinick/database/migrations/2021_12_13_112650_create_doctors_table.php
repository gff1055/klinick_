<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDoctorsTable.
 */
class CreateDoctorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctors', function(Blueprint $table) {

			/*
- Id do usuario
- nome no Registro CRM	string64
- numero do crm			string16

- especialidade1		string32
- numero1 rqe			string16
- especialidade2		string32
- numero2 rqe			string16
- especialidade3		string32
- numero3 rqe			string16

- Descricao				string256
- Modo de pagamento		string64
			 */
			$table->increments('id');
			$table->unsignedInteger('user_id');

			$table->string('registeredName', 64);
			$table->string('numberCrm', 16);
			$table->string('nameSpecialty1', 32);
			$table->string('numberRqe1', 16);
			$table->string('nameSpecialty2', 32)->nullable();
			$table->string('numberRqe2', 16)->nullable();
			$table->string('nameSpecialty3', 32)->nullable();
			$table->string('numberRqe3', 16)->nullable();
			$table->string('description', 256)->nullable();
			$table->string('modePayment', 64)->nullable();
			
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
		Schema::drop('doctors');
	}
}
