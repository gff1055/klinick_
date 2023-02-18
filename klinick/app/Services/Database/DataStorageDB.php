<?php

namespace App\Services\Database;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

use Illuminate\Support\Facades\DB;



class DataStorageDB implements DataStorageStructure{


	/*public function __construct(UserRepository $paramRepos, UserValidator $paramValid){
		$this->repository = $paramRepos;
		$this->validator = $paramValid;
	}*/

	/** Valida os dados */
	public function validate($pValidator, $pData){
		
		/** Testa se o validador e os dados estão corretos */
		if($pValidator && $pData){
			$feedback = [
				"validate" 	=> $pValidator->with($pData)->passesOrFail(ValidatorInterface::RULE_CREATE),
				"data" 		=> $pData
			];
		}

		else{
			$feedback = [
				"validate" 	=> null,
				"data" 		=> false
			];
		}

		return $feedback;
	}
	
	/** Armazena os dados */
	public function storeData($pRepository, $pData){
		$pRepository->create($pData);
	}


	/** Armazena os dados */
	public function searchData($pRepository, $fieldToBeSearched, $keySearch){
		
		/** Inicia variaveis de retorno */

		/** Busca o dado */
		/*foreach($pRepository as $userData){
			if($userData[$fieldToBeSearched] == $keySearch){
				array_push($result, $userData);
			}
		}*/

		/** Retorna */

/*		if($result == []){
			return false;
		}
		else return $result;*/
	}
}

?>



