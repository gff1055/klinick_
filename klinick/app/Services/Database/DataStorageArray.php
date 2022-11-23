<?php

namespace App\Services\Database;



class DataStorageArray implements DataStorageStructure{

	public function validate($pValidator, $pData){
		if($pValidator && $pData){
			return [
				"data" => $pData,
				"finished" => true
			];
		}

		else{
			return [
				"data" => null,
				"finished" => false
			];
		}
	}
	
	public function storeData($pRepository, $pData){
		$feedback = false;

		if($pData){
			array_push($pRepository, $pData);
			$feedback = true;
		}

		return $feedback;
	}
}

?>