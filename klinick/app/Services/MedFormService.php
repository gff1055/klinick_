<?php

namespace App\Services;

use App\Repositories\MedFormRepository;
use App\Validators\MedFormValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Entities\MedForm;
use App\Services\UserService;

use Illuminate\Support\Facades\DB;

use Exception;

class MedFormService{

	private $repository;
	private $validator;
	const REGISTERED_DATA = 313344;

	public function __construct(MedFormRepository $paramRepos, MedFormValidator $paramValid){
		$this->repository = $paramRepos;
		$this->validator = $paramValid;
	}

	public function validate($data){
		
		$data["date"] = date('Y/m/d');
		$data["status"] = 11;
		
		return [
			"validate" 	=> $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE),
			"data" 		=> $data
		];
	}

	

	public function store($pData){
		$data = $this->validate($pData)["data"];
		$this->repository->create($data);
	}

	public function search(){

	}

	public function close(){

	}

	public function update(){
		
	}



	


}

?>
