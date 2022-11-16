<?php

namespace App\Services\Database;



class DataStorageArray implements DataStorageStructure{

	public function validate($pData){
		return $pData;
	}
	
	public function store($pRepository, $pData){
		array_push($pRepository, $pData);
		return true;
	}
}

?>