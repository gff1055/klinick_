<?php

namespace App\Services;

use App\Repositories\MedFormRepository;
use App\Validators\MedFormValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Entities\MedForm;
use App\Services\UserService;

use Illuminate\Support\Facades\DB;

class MedFormService{

	private $repository;
	private $validator;

	public function __construct(MedFormRepository $paramRepos, MedFormValidator $paramValid){
		$this->repository = $paramRepos;
		$this->validator = $paramValid;
	}

	public function store($data){
		return $data;
	}

	public function search(){

	}

	public function close(){

	}

	public function update(){
		
	}



	


}

?>
