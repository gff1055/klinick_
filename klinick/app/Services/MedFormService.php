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
				
		if(!$feedback["validate"])	$success = false;
		else						$success = $feedback["validate"];

		return [
			"data"		=> $feedback["data"],
			"success"	=> $success
		];
	}


	/** altera o atributo status para exibicao */
	public function setStatusDisplay($pStatus){
		if($pStatus == 11)		$pStatus = "Esperando médico";
		elseif($pStatus == 12)	$pStatus = "Atendimento iniciado";
		elseif($pStatus == 22)	$pStatus = "Atendimento concluido";

		return $pStatus;
	}


	/** prepara a ficha para exibicao */
	public function prepareForDisplay($pArray){

		for($i = 0; $i < count($pArray); $i++){
			$pArray[$i]->descStatus = $this->setStatusDisplay($pArray[$i]->status);
		}

		return $pArray;
	}


	public function store($pData){
		try{
		
			$ready = $this->preparation($this->validator, $pData);
			$this->storage->storeData($this->repository, $ready["data"]);
					
			// Em caso de excecao, o array indicando excecao é enviado para a view
		}catch(Exception $except){
			return [
				'success'	=> false,
				'message'	=> 'Erro interno',
				'data'		=> $except
			];
		}
	}

	
	public function searchUserMedForms($pIdUser){
		return DB::select('select * from med_forms where user_id = ? order by date desc', [$pIdUser]);
	}

	public function searchAllMedForms(){
		return DB::select('
			select m.id, m.state, m.city, m.complaint, m.status, u.name 
			from med_forms as m, users as u
			where m.user_id = u.id 
			order by date
			desc'
		);
	}

	
	public function searchMedForm($pIdMedForm){

		/*try {*/
			$medform 				= DB::select('select * from med_forms where id = ?', [$pIdMedForm])[0];
			$medform->descStatus	= $this->setStatusDisplay($medform->status);
			
			$user 		= DB::select('select id, name from users where id = ?', [$medform->user_id])[0];

			return[
				"medform" 	=> $medform,
				"user"		=> $user
			];
		/*} catch (Exception $th) {
			return "Erro inesperado! Code: 4C3S01N3V1D0" . $th;
		}*/
		
	}

	
	public function searchDetailedMedForm($pIdMedForm){
		return $this->searchMedForm($pIdMedForm);
/*		$userInfo	= DB::select('select * from users where id = ?', [dForm])[0];*/
	}

	public function setDoctorToMedForm($pIdDoctor, $pIdMedForm){
		$data = $this->searchMedForm($pIdMedForm);
		$data['medform']->doctor_id = $pIdDoctor;
	}

	/** apaga uma ficha de consulta */
	public function delete($idMedForm){
		
		$data = $this->searchMedForm($idMedForm);
		/*dd($data);*/

				

		if($data['medform']->status == 11){
			$opDelete = DB::delete("delete from med_forms where id = ?", [$data['medform']->id]);

			$arrayDataFeedback = [				
				'success'	=> true,
				'code'		=> '888',
				'data'		=> $opDelete
			];
		}

		else if($data['medform']->status == 12 || $data['medform']->status == 22){
			$arrayDataFeedback = [				
				'success'	=> false,
				'code'		=> '0xAT31ME0IN11AD0',
			];
		}

		else{
			$arrayDataFeedback = [				
				'success'	=> false,
				'code'		=> '0xER03SC03CI0',
			];
		}

		return $arrayDataFeedback;
	}

	public function close(){}

	public function update(){}



	


}

?>
