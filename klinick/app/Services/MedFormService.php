<?php

namespace App\Services;

use App\Repositories\MedFormRepository;
use App\Validators\MedFormValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use App\Entities\MedForm;

use App\Services\Database\DataStorageDB;

use App\Services\UserService;

use Illuminate\Support\Facades\DB;

use Exception;

class MedFormService{

	private $repository;
	private $validator;
	private $storage;
	const REGISTERED_DATA = 313344;

	public function __construct(
		MedFormRepository $paramRepos,
		MedFormValidator $paramValid,
		DataStorageDB $paramStorage
		){
		$this->repository = $paramRepos;
		$this->validator = $paramValid;
		$this->storage = $paramStorage;
	}

	/** Adiciona um item ao array passado pData */
	public function add($pData, $pAttribute, $pValue){
		$pData[$pAttribute] = $pValue;
		return $pData; 
	}

	/** Prepara e identifica os dados para insercao */
	public function preparation($pValidator, $pData){
		$pData = $this->add($pData, "date", date('Y/m/d'));
		$pData = $this->add($pData, "status", 11);
		
		$feedback	= $this->storage->validate($pValidator, $pData);
				
		if(!$feedback["validate"]){
			$success = false;
		}
		else{
			$success = $feedback["validate"];
		}

		return [
			"data"		=> $feedback["data"],
			"success"	=> $success
		];
	}


	public function store($pData){
		try{
		
			$ready = $this->preparation($this->validator, $pData);
			$this->storage->storeData($this->repository, $ready["data"]);
					
			// Em caso de excecao, o array indicando excecao é enviado para a view
		}catch(Exception $except){
			return [
				'success' => false,
				'message' => 'Erro interno',
				'data' => $except
			];
		}
	}

	
	/** busca as fichas de um usuario */
	public function searchUserMedForms($pIdUser){
		return DB::select('select * from med_forms where user_id = ? order by date desc', [$pIdUser]);
	}

	/** busca uma ficha de consulta */
	public function searchMedForm($pId){
		return DB::select('select * from med_forms where id = ?', [$pId])[0];
	}

	/** apaga uma ficha de consulta */
	public function delete($idMedForm){

		$medForm = $this->searchMedForm($idMedForm);

		if($medForm->status == 11){
			$opDelete = DB::delete("delete from med_forms where id = ?", [$medForm->id]);

			$arrayDataFeedback = [				
				'success' => true,
				'code' => '888',
				'data' => $opDelete
			];
		}

		else if($medForm->status == 12 || $medForm->status == 22){
			$arrayDataFeedback = [				
				'success' => false,
				'code' => '0xAT31ME0IN11AD0',
			];
		}

		else{
			$arrayDataFeedback = [				
				'success' => false,
				'code' => '0xER03SC03CI0',
			];
		}

		return $arrayDataFeedback;
	}

	public function close(){}

	public function update(){}



	


}

?>
