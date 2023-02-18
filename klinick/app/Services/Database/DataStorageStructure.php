<?php

namespace App\Services\Database;

interface DataStorageStructure{

	public function validate($pValidator, $pData);

	public function storeData($pRepository, $pData);

	public function searchData($pRepository, $fieldToBeSearched, $keySearch);

}

?>