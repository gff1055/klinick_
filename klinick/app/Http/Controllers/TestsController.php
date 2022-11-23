<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TestCreateRequest;
use App\Http\Requests\TestUpdateRequest;
use App\Repositories\TestRepository;
use App\Validators\TestValidator;

use App\Http\Controllers\MedFormsController;
use App\Services\MedFormService;
use App\Validators\MedFormValidator;

use App\Services\Database\DataStorageArray;
use App\Services\Database\DataStorageDB;


/**
 * Class TestsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TestsController extends Controller{

	protected $rep;
	protected $val;
	protected $medF_contr;
	protected $medF_serv;
	protected $dat_stor_arr;
	protected $dat_stor_db;
	
	public function __construct(
		TestRepository $repository,
		TestValidator $validator,
		MedFormsController $medForm_controller,
		MedFormService $medForm_service,
		DataStorageArray $dat_storage_array,
		DataStorageDB $dat_storage_db
	){
        $this->rep 				= $repository;
		$this->val  			= $validator;

		$this->medF_contr		= $medForm_controller;
		$this->medF_serv 		= $medForm_service;
		$this->dat_stor_arr		= $dat_storage_array;
		$this->dat_stor_db		= $dat_storage_db;
	}
	
	public function running(){

		$medForm_service_store_array = [
			"city"			=> "1",
  			"state"			=> "2",
  			"complaint"		=> "3",
  			"paymentMethod"	=> "dinheiro",
		];

		$id = "5";

/*		$this->testing(
			"testa insercao do id do usuario",
			"medForm_controller->identifyData()",
			$this->medF_contr->identifyData($medForm_service_store_array,$id)['content']['user_id'],
			$id
		);*/

		$medForm_service_store_array = [
			"city"			=> "1",
  			"state"			=> "2",
  			"complaint"		=> "3",
			"paymentMethod"	=> "dinheiro",
			"user_id"		=> "2"
			  
		];
		$test_valid = true;
		$repositoryArray = [];

		/*$this->testing("testar validacao de dados","dat_structure_array->validate()",$this->dat_stor_arr->validate($test_valid,$medForm_service_store_array)["finished"],true);*/

		$array_false = [];

/*		$this->testing("testar validacao de dados em caso de falha","dat_structure_array->validate()",$this->dat_stor_arr->validate($test_valid,$array_false)["finished"],false);*/

		$this->testing(
			"testar adicao de atributos",
			"medForm_service->add()",
			$this->medF_serv->add(
				$medForm_service_store_array,
				"teste",
				"teste2"
			),
			true
		);

		$this->testing(
			"testar validacao de dados no Banco de dados",
			"dat_stor_db->validate()",
			$this->dat_stor_db->validate(
				$this->val,
				$medForm_service_store_array
			)["data"],
			true
		);

		$this->testing(
			"testar validacao de dados no Banco de dados em caso de falha",
			"dat_stor_db->validate()",
			$this->dat_stor_db->validate(
				$this->val,
				$array_false
			)["data"],
			false
		);

		$this->testing(
			"testar preparacao de dados a serem inseridos",
			"medForm_service->preparation()",
			$this->medF_serv->preparation(
				$this->val,
				$medForm_service_store_array
			)["data"]["date"],
			true
		);

		$this->testing(
			"testar preparacao de dados a serem inseridos",
			"medForm_service->preparation()",
			$this->medF_serv->preparation(
				null,
				$array_false
			)["data"],
			false
		);

		$this->testing(
			"testa o armazenamento dos dados no repositorio (array)",
			"medForm_service->store()",
			$this->dat_stor_arr->storeData(
				$repositoryArray,
				$medForm_service_store_array
			),
			true
		);

		$this->testing(
			"testa o armazenamento dos dados no repositorio (array) em caso de falha",
			"medForm_service->store()",
			$this->dat_stor_arr->storeData($repositoryArray, $array_false),
			false
		);

		/*$this->testing(
			"testa o armazenamento dos dados no repositorio (DB) em caso de falha",
			"medForm_service->store()",
			$this->medF_serv->storeData($repositoryArray, $array_false)["success"],
			true
		);*/


		/*$this->testing(
			"medForm_service->validateData()",
			$this->medForm_service->validate($medForm_service_store_array)["data"],
			true
		);*/

		/*$this->testing(
			"medForm_service->store()",
			$this->medForm_service->store($medForm_service_store_array),
			MedFormService::REGISTERED_DATA
		);*/

	}

	public function testing($desc, $name, $func, $res){
		echo "<br>";
		var_dump($func);
		echo "<br>";
		echo $func == $res ? $name." PASSOU" : $name." NAO PASSOU";
		echo "<br>";
	}

    
}
