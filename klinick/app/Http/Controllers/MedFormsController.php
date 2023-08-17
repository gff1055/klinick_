<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MedFormCreateRequest;
use App\Http\Requests\MedFormUpdateRequest;
use App\Repositories\MedFormRepository;
use App\Validators\MedFormValidator;

use App\Services\MedFormService;

use Auth;
use Exception;

use App\Http\Controllers\Controller;

/**
 * Class MedFormsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MedFormsController extends Controller
{
    protected $repository;
	protected $service;
	private $feedback;

    /**
     * MedFormsController constructor.
     *
     * @param MedFormRepository $repository
     * @param MedFormValidator $validator
     */
    public function __construct(MedFormRepository $pRepository, MedFormService $pService){
        $this->repository = $pRepository;
        $this->service  = $pService;
	}

	public function setFeedback($message){ $this->feedback = $message; }
	public function getFeedback(){ return $this->feedback; }
	

	/** Funcao que adiciona o id do usuario*/
	public function insertUserId($data, $id){
		
		$data["user_id"] = $id;
		
		$feedback = [
			"content" 			=> $data,
			"message"			=> "Success"
		];
		
		return $feedback;
	}

	
	/**  */
    public function index($userId){

		if(!Controller::isAuthenticated())
			return redirect()->route('user.login_get');

			
		$dataAllMedForm = $this->service->searchUserMedForms(Auth::user()->id);
		$dataAllMedForm = $this->service->prepareForDisplay($dataAllMedForm);

		return view('medForm.index', [
			"user" 				=> Auth::user(),
			"dataAllMedForm"	=> $dataAllMedForm
			/*"feedback"	=> /*$feedback*/
		]);
	}
	

	/** armazena as fichas */
    public function store(MedFormCreateRequest $request){

		$enteredData	= $this->insertUserId($request->all(), Auth::user()->id);
		$result			= $this->service->store($enteredData["content"]);
		return redirect()->route("medform.index", ["user" => Auth::user()->id]);
	}
	

	/** mostra a ficha de um usuario */
	public function show($idUser, $idMedForm){

		if(!Controller::isAuthenticated())
			return redirect()->route('user.login_get');
		
		$medForm			= $this->service->searchMedForm($idMedForm)['medform'];
		$medForm->status	= $this->service->setStatusDisplay($medForm->status);

        return view('medForm.show', [
			"dataMedForm" => $medForm,
			"user" => Auth::user()
		]);
				
    }


	
	public function delete(Request $request, $userId, $medFormId){
		
		/*$medformId 	= $request['medform_id'];
		/*$medformId 	= 5;*/
		
		/*$userId		= $request['user_id'];*/

		$feedback = $this->service->delete($medFormId);

		if($feedback['success'])
			$msgFeedback = "A ficha de atendimento foi excluida";
		
		else
			$msgFeedback = "ERRO ao excluir. ERRO: ".$feedback['code'];

		/*return redirect()->route('medform.index', [
				"user"		=> Auth::user()->id,
				"feedback" => $this->getFeedback()
				]);*/
				return redirect()
				->action('MedFormsController@index',["user" => Auth::user()->id])
				->with('mensagem', $msgFeedback);
	    
		
	}
}