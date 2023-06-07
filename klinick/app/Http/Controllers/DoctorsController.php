<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//use Prettus\Validator\Contracts\ValidatorInterface;
//use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DoctorCreateRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Repositories\DoctorRepository;
use App\Validators\DoctorValidator;

use App\Services\MedFormService;

use App\Entities\Doctor;
use App\Services\DoctorService;


use Auth;
use Exception;

use App\Http\Controllers\Controller;


class DoctorsController extends Controller{
	
	protected $repository;
	protected $service;
	protected $mfService;
	
	const DOCTOR = 2;
	const USER = 1;
	const UNLOGGED = 0;

    public function __construct( 
		DoctorRepository $repository,
		DoctorService $service,
		MedFormService $mfService
		){

        $this->repository	= $repository;
		$this->service 		= $service;
		$this->mfService	= $mfService;
	}

	public function accessByADoctor(){	return $this->analyzeAccess() == self::DOCTOR;	}
	public function accessByAUser(){	return $this->analyzeAccess() == self::USER;	}

	
	public function agreement(){
		
		if(Controller::isAuthenticated()){
			return view('doctor.agreement');
		}
		else{
			return redirect()->route('user.login_get');
		}
	}


	public function analyzeAccess(){
		if(Controller::isAuthenticated()){
			if(Auth::user()->isADoctor)	return self::DOCTOR;
			else						return self::USER;
		}

		else							return self::UNLOGGED;
	}


	public function accessViewOrRoute($view, $arrDataView, $defaultRoute){

		if($this->accessByADoctor())	return view($view, $arrDataView);
		else							return redirect()->route($defaultRoute);
	}

	public function getDoctorId($pUserId){
		$lDoctor = $this->service->searchDoctor($pUserId);
		return $lDoctor->id;
	}

	
	
    public function index(){
		$doctorId = $this->getDoctorId(Auth::user()->id);
		return $this->accessViewOrRoute('doctor.index', ["user" => Auth::user(), "doctorId" => $doctorId] ,'user.login_get');
	}
	

	public function create(){
		if(Controller::isAuthenticated()){
			return view('doctor.create');
		}
		else{
			return redirect()->route('user.login_get');
		}
    }


    public function store(DoctorCreateRequest $request){

		$idUserLogged 	= Auth::user()->id;
		$registeredData	= $request->all();

		$registeredData["user_id"] = $idUserLogged;

		$this->service->store($registeredData);

		return redirect()->route('doctor.index');
    }

	
	public function show($id){

		if(Controller::isAuthenticated()){

			$doctor = $this->repository->find($id);
			/*if (request()->wantsJson()) {
				return response()->json([
					'data' => $doctor,
				]);
			}*/
	
			return view('doctor.show', [
				"doctor" => $doctor,
				"user" => Auth::user()
			]);

		}

		else{
			return redirect()->route('user.login_get');
		}
    }


    public function edit($id){
        $doctor = $this->repository->find($id);
        return view('doctors.edit', compact('doctor'));
    }


	public function settings(){
		return $this->accessViewOrRoute('doctor.settings', [], 'user.login_get');
	}

	public function settingsDelete(){
		return $this->accessViewOrRoute('doctor.settingsDelete', ["user" => Auth::user()], 'user.login_get');
	}


	
	public function deleteDoctor(DoctorUpdateRequest $request){
		
		$doctorAuthenticationData = [
			"password"	=> $request->all()['password'],
			"id" 		=> Auth::user()->id,
			"success" 	=> Auth::user()
		];

		$feedbackOperarion = $this->service->delete($doctorAuthenticationData);
		echo json_encode($feedbackOperarion);

		/**
		 * Chamar a funcao de exclusao e enviar dados
		 * retornar a resposta
		 */
		//echo json_encode($answer);
		return;
    }


	public function update(DoctorUpdateRequest $request, $id){
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $doctor = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Doctor updated.',
                'data'    => $doctor->toArray(),
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


    public function destroy($id){
		/*
        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Doctor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Doctor deleted.');*/
	}
	
	public function loadAppointments($doctorId){
		if(!Controller::isAuthenticated())
			return redirect()->route('user.login_get');

		/** implementar se o usuario é medico de fato (DEPOIS) */

		/** exibicao dos medformsd '-' */
		$medForms = $this->mfService->searchAllMedForms();
		$medForms = $this->mfService->prepareForDisplay($medForms);

		$feedback = [
			'success'	=> true,
			'data'		=>$medForms
		];

		/*dd($feedback);*/

		return view('doctor.loadAppointments.docLoaApp', ["medForms" => $feedback]);

	}
}
