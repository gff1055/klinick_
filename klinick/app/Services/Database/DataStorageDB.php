<?php

namespace App\Services\Database;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;



class DataStorageDB implements DataStorageStructure{

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
}

?>



