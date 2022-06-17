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
//		$user = new UserService($a, $b);

		try{			
			$t = $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$doctor = $this->repository->create($data);
			DB::table('users')->where('id',$data['user_id'])->update(['isADoctor' => true]);
		}
		
		catch(Exception $except){
			return 0;
		}
	}


	public function isADoctor($pIdDoctor){
		$isDoctor = DB::select('select * from doctors where user_id = ?', $id);
	}


	/**
	 * FUNCAO		: delete
	 
	 * OBJETIVO		: Efetuar a exclusao do usuario da base de dados
	 
	 * PARAMETROS	: $user - Dados do usuario a ser excluido
	 
	 * RETORNO		: Array com feedback da atualizacao
	 */	
	public function delete($doctor){
	}


}


?>