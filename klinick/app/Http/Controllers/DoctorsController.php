<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DoctorCreateRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Repositories\DoctorRepository;
use App\Validators\DoctorValidator;

use App\Http\Controllers\Controller;


class DoctorsController extends Controller{
    /**
     * @var DoctorRepository
     */
    protected $repository;

    /**
     * @var DoctorValidator
     */
    protected $validator;

    /**
     * DoctorsController constructor.
     *
     * @param DoctorRepository $repository
     * @param DoctorValidator $validator
     */
    public function __construct(DoctorRepository $repository, DoctorValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
	}
	
	public function agreement(){
		
		if(Controller::isAuthenticated()){
			return view('doctor.agreement');
		}
		else{
			return redirect()->route('user.login_get');
		}
	}



    
    public function index(){
        /*$this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $doctors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $doctors,
            ]);
        }

		return view('doctors.index', compact('doctors'));*/
		
	}
	

	public function create(){
		return view("doctor.create");		
    }


    public function store(DoctorCreateRequest $request){
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $doctor = $this->repository->create($request->all());

            $response = [
                'message' => 'Doctor created.',
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

	
	public function show($id){
        $doctor = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $doctor,
            ]);
        }

        return view('doctors.show', compact('doctor'));
    }


    public function edit($id){
        $doctor = $this->repository->find($id);

        return view('doctors.edit', compact('doctor'));
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Doctor deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Doctor deleted.');
    }
}
