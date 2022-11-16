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

/**
 * Class TestsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TestsController extends Controller
{
	protected $repository;
	protected $validator;
	protected $medForm_controller;
	protected $medForm_service;
	//protected $medForm_validator;
	
	public function __construct(
		TestRepository $repository,
		TestValidator $validator,
		MedFormsController $medForm_controller,
		MedFormService $medForm_service
	){
        $this->repository 			= $repository;
		$this->validator  			= $validator;

		$this->medForm_controller	= $medForm_controller;
		$this->medForm_service 		= $medForm_service;
		//$this->medForm_validator	= $medForm_validator;
	}
	
	public function running(){

		$medForm_service_store_array = [
			"city"			=> "1",
  			"state"			=> "2",
  			"complaint"		=> "3",
  			"paymentMethod"	=> "dinheiro",
		];

		$t = "5";

		$this->testing(
			"medForm_controller->identifyData()",
			$this->medForm_controller->identifyData($medForm_service_store_array,$t)['content']['user_id'],
			$t
		);

		$medForm_service_store_array = [
			"city"			=> "1",
  			"state"			=> "2",
  			"complaint"		=> "3",
			"paymentMethod"	=> "dinheiro",
			"user_id"		=> "2"
			  
		];

		$this->testing(
			"medForm_service->validateData()",
			$this->medForm_service->validate($medForm_service_store_array)["data"],
			true
		);

		/*$this->testing(
			"medForm_service->store()",
			$this->medForm_service->store($medForm_service_store_array),
			MedFormService::REGISTERED_DATA
		);*/

	}

	public function testing($name, $func, $res){
		echo "<br>";
		var_dump($func);
		echo "<br>";
		echo $func == $res ? $name." PASSOU" : $name." NAO PASSOU";
		echo "<br>";
	}

    
}
