<?php

namespace App\Services;

use App\Repositories\DoctorRepository;
use App\Validators\DoctorValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Entities\Doctor;

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

		/** Tentar inserir atributo id do usuario no final do array */

		//$data["user_id"] = $id;

		try{			
			$t = $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$doctor = $this->repository->create($data);
		}
		
		catch(Exception $except){
			return 0;
		}
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