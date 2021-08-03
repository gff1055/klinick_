<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

use Illuminate\Support\Facades\DB;

class UserService{

	private $repository;
	private $validator;

	public function __construct(UserRepository $paramRepos, UserValidator $paramValid){
		$this->repository = $paramRepos;
		$this->validator = $paramValid;
	}




	/**
	 * FUNCAO		: store
	 * OBJETIVO		: Armazenar os dados no banco
	 * ARGUMENTOS	: $data - Os dados a serem armazenados
	 * RETORNO		: $arrayDataFeedback - ARRAY com as seguintes informações
	 * 					'success' 	-> indica se houve sucesso ou falha
	 * 					'code' 		-> codigo do erro
	 * 					'message' 	-> Mensagem que explica o erro
	 * 					'data' 		-> os dados enviados
	 */
	
	 public function store($data){
	
		try{
			
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			// Inicializando uma variavel com o feedback da existencia(ou nao) do usuario informado
			/*$userExist = DB::select('select * from users where username = ?', [$data['username']]);

			// Inicializando array que lista os erros ou sucesso no cadastro
			$arrayDataFeedback = [];
			
			// Se já existir um usuario cadastrado com os dados fornecidos
			// o array indicando falha é enviado para a view
			if($userExist){
				$arrayDataFeedback[] = [
					'success' => false,
					'code' => '55418313',
					'message' => 'Já exite uma conta com esse nome de usuario',
					'data' => null
				];
			}*/

			// Variavel recebe o feedback da existencia(ou nao) do email informado
			$emailExist = DB::select('select * from users where email = ?', [$data['email']]);

			// Se já existir um email cadastrado com os dados fornecidos
			// o array indicando falha é enviado para a view
			if($emailExist){
				
				$arrayDataFeedback[] = [
					'success' => false,
					'code' => '341313',
					'message' => 'Já exite uma conta associada com esse email',
					'data' => null
				];
	
			}

			// Se não existir nenhum nome de usuario/email cadastrado com os dados fornecidos
			// o array indicando sucesso é enviado para a view
			//if(!$userExist && !$emailExist){
			else{
	
				$user = $this->repository->create($data);
		
				$arrayDataFeedback[] = [
					'success' => true,
					'code' => '538',
					'message' => 'Usuario Cadastrado',
					'data' => $user
				];
			}

			return $arrayDataFeedback;
		}

		// Em caso de excecao, o array indicando excecao é enviado para a view
		catch(Exception $except){
			return[
				'success' => 'false',
				'message' => 'Erro interno',
				'data' => null
			];
	
		}
	
	}



	/**
	 * FUNCAO		: Update
	 * OBJETIVO		: Efetuar a atualizacao dos dados do usuario
	 * PARAMETROS
	 * 	: $data - Dados a serem atualizados
	 * 	: $typeData -  Tipos de dados
	 * 		1 -> Dados pessoais
	 * 		2 -> Dados de autenticacao (Email ou senha)
	 * 	: $id - ID do usuario cujos dados serao atualizados
	 * RETORNO		: Array com feedback da atualizacao
	 */
	public function update($data, $typeData, $id){

		$hasConflictData = false;					// Flag que indica se houve conflito de dados
				
		try{
			
			//$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			// Testa o tipo de dados que estao sendo atualizados (Dados pessoais ou Dados de autenticacao)
			if($typeData == 2){

				$emailExist = DB::select('select * from users where email = ? and id <> ?', [$data['email'], $id]);					// Variavel recebe o feedback da existencia(ou nao) do email informado

				// Se já existir um email cadastrado com os dados fornecidos
				// o array indicando falha é enviado para a view
				if($emailExist){

					$hasConflictData = true;		// acionada flag de conflito de dados
				
					$arrayDataFeedback[] = [		// Carregando Array com o codigo de erro
						'success' => false,
						'code' => '341313',
						'message' => 'Já exite uma conta associada com esse email',
						'data' => null
					];
	
				}
			}

			// Testa se não houver nenhum conflito de dados
			if(!$hasConflictData){
	
				$user = $this->repository->update($data, $id);			// Atualiza os dados do usuario
		
				$arrayDataFeedback[] = [			// Carregado array com os dados e codigo de sucesso
					'success' => true,
					'code' => '538',
					'message' => 'Usuario Cadastrado',
					'data' => $user
				];
			}

			return $arrayDataFeedback;				// Retorna array de feedback do update
		}

		// Em caso de excecao, o array indicando excecao é enviado para a view
		catch(Exception $except){
			return[
				'success' => 'false',
				'message' => 'Erro interno',
				'data' => null
			];
	
		}
	}

	public function delete(){

	}

}


?>