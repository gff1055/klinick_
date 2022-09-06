<?php

namespace App\Services;

use App\Repositories\DoctorRepository;
use App\Validators\DoctorValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Entities\Doctor;
use App\Services\UserService;

use Illuminate\Support\Facades\DB;

class DoctorService{

	private $repository;
	private $validator;

	public function __construct(DoctorRepository $paramRepos, DoctorValidator $paramValid){
		$this->repository = $paramRepos;
		$this->validator = $paramValid;
	}






	/**
	 * 
	 * FUNCAO		: store
	 * 
	 * OBJETIVO		: Armazenar os dados no banco
	 * 
	 * ARGUMENTOS	: $data - Os dados a serem armazenados
	 * 
	 * RETORNO		: $arrayDataFeedback - ARRAY com as seguintes informações
	 * 					'success' 	-> indica se houve sucesso ou falha
	 * 					'code' 		-> codigo do erro
	 * 					'message' 	-> Mensagem que explica o erro
	 * 					'data' 		-> os dados enviados
	 * 
	 */
	
	public function store($data){

		try{			
			$t = $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$doctor = $this->repository->create($data);
			UserService::setUserAsDoctor($data['user_id']);
			//DB::table('users')->where('id',$data['user_id'])->update(['isADoctor' => true]);
		}
	
		catch(Exception $except){
			return 0;
		}
	}


	public function isADoctor($pIdUser){
		/*$isDoctor = DB::select('select * from doctors where user_id = ?', $id);
		return $isDoctor;*/
	}


	public function delete($pDoctorAuthenticationData){
		
		$checkDoctorUser = UserService::checkUser($pDoctorAuthenticationData['password'], $pDoctorAuthenticationData['id']);
		
		if($checkDoctorUser){
			
			$opDelete = DB::delete("delete from doctors where user_id = ?", [$pDoctorAuthenticationData['id']]);
			UserService::unsetUserAsDoctor($pDoctorAuthenticationData['id']);
			
			$feedbackData = [				
				'success' => true,
				'code' => '888',
		//		'data' => $opDelete
			];
		}
		
		else{
			$feedbackData = [				
				'success' => false,
				'code' => '341834',
			];
		}

		return $feedbackData;
	}


}


?>