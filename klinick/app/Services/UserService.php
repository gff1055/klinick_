<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Entities\User;

use Illuminate\Support\Facades\DB;

class UserService{

	private $repository;
	private $validator;

	public function __construct(UserRepository $paramRepos, UserValidator $paramValid){
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
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
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
			return [
				'success' => 'false',
				'message' => 'Erro interno',
				'data' => null
			];
		}
	}




	/**
	 * 
	 * FUNCAO		: updatePersonalData
	 * 
	 * OBJETIVO		: Efetuar a atualizacao dos dados do usuario
	 * 
	 * PARAMETROS	: $data		- Dados pessoais a serem atualizados
	 * 				: $id 		- ID do usuario cujos dados serao atualizados
	 * 
	 * RETORNO		: Array com feedback da atualizacao
	 * 
	 */
	public function updatePersonalData($data, $id){
		
		// Flag que indica se houve conflito de dados
		$hasConflictEmail = false;					
		
		try{			
			$emailExist = DB::select('select * from users where email = ? and id <> ?', [$data['email'], $id]);					// Variavel recebe o feedback da existencia(ou nao) do email informado
			
			// Se já existir um email cadastrado com os dados fornecidos
			// o array indicando falha é enviado para a view
			if($emailExist){
				$hasConflictEmail = true;			// acionada flag de conflito de dados
				$arrayDataFeedback = [				// Carregando Array com o codigo de erro
					'success' => false,
					'code' => '341313',
					'message' => 'Já exite uma conta associada com esse email',
					'data' => null
				];
			}
			
			// Testa se não houver nenhum conflito de dados
			if(!$hasConflictEmail){
				$user = $this->repository->update($data, $id);			// Atualiza os dados do usuario
				$arrayDataFeedback = [				// Carregado array com os dados e codigo de sucesso
					'success' => true,
					'code' => '538',
					'message' => 'Usuario Atualizado',
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


	/**
	 * 
	 * FUNCAO		: checkUser
	 * 
	 * OBJETIVO		: Verifica se a senha associado ao id do usuario esta correta
	 * 
	 * PARAMETROS	: $password		- Senha digitada pelo usuario
	 * 				: $id 			- ID do usuario atual
	 * 
	 * RETORNO		: Retorna se a senha esta correta(true) ou nao(false)
	 * 
	 */
	public function checkUser($password, $id){
		$query = DB::select('select * from users where password like ? and id = ?', [$password, $id]);
		if($query){
			return true;
		}
		else{
			return false;
		}
	}





	/**
	 
	* FUNCAO		: updateAuthData
	 
	* OBJETIVO		: Efetuar a atualizacao da senha do usuario
	 
	* PARAMETROS	: $data - Dados a serem atualizados
	* 				: $id 	- ID do usuario cujos dados serao atualizados
	 
	* RETORNO		: Array com feedback da atualizacao
	 
	*/
	public function updateAuthData($data, $id){
		try{
			// Confirma se a senha digitada esta correta
			$passwordIsCorrect = $this->checkUser($data['password'], $id);			// Variavel recebe o feedback da existencia(ou nao) do email informado
			//$passwordIsCorrect = DB::select("select * from users where password like ? and id = ?", [$data['password'], $id]);			// Variavel recebe o feedback da existencia(ou nao) do email informado
			
			// Se a senha digitada estiver correta, é feita a troca pela nova senha
			if($passwordIsCorrect){

				// Após a atualizacao da senha, um array é gerado com o resultado da operacao
				$successUpdate = DB::update('update users set password = ? where id = ?', [$data['newPassword'], $id]);
				
				if($successUpdate){
					$arrayDataFeedback = [
						'success' => true,
						'code' => '34454144',
					];
				}
				else{
					$arrayDataFeedback = [
						'Resume' => 'Erro interno na atualizacao',
						'Erro' => $successUpdate
					];
				}

			}			
			
			// Se a senha digitada não estiver correta, é gerado o feedback
			else{	
				$arrayDataFeedback = [				
					'success' => false,
					'code' => '341834',
					'message' => 'A senha digitada está incorreta.',
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
	 * FUNCAO		: delete
	 
	 * OBJETIVO		: Efetuar a exclusao do usuario da base de dados
	 
	 * PARAMETROS	: $user - Dados do usuario a ser excluido
	 
	 * RETORNO		: Array com feedback da atualizacao
	 */	
	public function delete($user){

		// Verifica se a senha está correta
		$checkingUser = $this->checkUser($user['password'], $user['id']);

		// Se a senha estiver correta, o usuario é excluido.
		// Um array com o resultado da operacao é gerado em ambos os casos
		if($checkingUser){
			$opDelete = DB::delete("delete from users where id = ?", [$user['id']]);
			$arrayDataFeedback = [				
				'success' => true,
				'code' => '888',
				'data' => $opDelete
			];
		}
		else{
			$arrayDataFeedback = [				
				'success' => false,
				'code' => '341834',
			];
		}

		return $arrayDataFeedback;
	}
}


?>