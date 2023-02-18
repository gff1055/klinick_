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
	
	/** Funcao que adiciona o id do usuario*/
	public function insertUserId($data, $id){
		
		$data["user_id"] = $id;
		
		$feedback = [
			"content" 			=> $data,
			"message"			=> "Success"
		];
		
		return $feedback;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId){
		
		$dataAllMedForm = $this->service->search(Auth::user()->id);

		/*dd($dataAllMedForm);*/

		return view('medForm.index', [
			"user" => Auth::user(),
			"dataAllMedForm" => $dataAllMedForm
		]);
    }

    public function store(MedFormCreateRequest $request){

		$enteredData = $this->insertUserId($request->all(), Auth::user()->id);
		$result = $this->service->store($enteredData["content"]);
		return redirect()->route("medform.index", ["user" => Auth::user()->id]);
	
		/*if($result["success"] == false)
			echo $result["data"];*/

		
	}


	public function allMedForms(){
    }
	


    public function show($id){
        $medForm = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $medForm,
            ]);
        }

        return view('medForms.show', compact('medForm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medForm = $this->repository->find($id);

        return view('medForms.edit', compact('medForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MedFormUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MedFormUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $medForm = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MedForm updated.',
                'data'    => $medForm->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'MedForm deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MedForm deleted.');
    }
}
