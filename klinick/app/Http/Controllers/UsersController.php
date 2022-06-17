<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//use Prettus\Validator\Contracts\ValidatorInterface;
//use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Entities\User;
use App\Services\UserService;
use Auth;
use Exception;

use App\Http\Controllers\Controller;

class UsersController extends Controller{
    
    protected $repository;
    protected $service;
    
	public function __construct(UserRepository $repository, UserService $service){

        $this->repository = $repository;
		$this->service = $service;
		
    }
    
    /**
     * FUNCAO:      register
     * OBJETIVO:    acionar a view para cadastro de novo usuario
     * RETORNO:     view propriamente dita
     */
	public function create(){
		return view('user.create');
    }
    
    

    
    /**
     * FUNCAO:      index
     * OBJETIVO:    acionar a view padrao do site
     * RETORNO:     retorna a view de login ou a view de perfil do usuario (no caso de usuarios ja logados)
     */
	public function index(){

		if(Controller::isAuthenticated()){
			return view('user.index', ["user" => Auth::user()]);
		}
		else
			return redirect()->route('user.login_get');

	}




    /**
     * FUNCAO:      store
     * OBJETIVO:    Cadastrar o usuario
     * ARGUMENTOS:  Dados inseridos pelo usuario
     * RETORNO:     Feedback com os dados necessarios para avaliar se (nao) houve falha no cadastro
     */
	public function store(UserCreateRequest $request){

		$registeredData = $request;
		
		
		$request = $this->service->store($request->all());

        // O usuario sendo cadastrado com sucesso, ou nao,
        // os dados referentes são enviados para a view

		// Se o cadastro é efetuado o usuario é logado automaticamente
		if($request[0]['success']){
			Auth::login($request[0]['data']);
			// Decodifica em json   
            echo json_encode($request);
			return;
			
        }
		else{
            echo json_encode($request);
            return;
		}
	
	}




     /**
     * FUNCAO       : settingsPersonalData
     * OBJETIVO     : Exibir formulario de alterar dados pessoais
     * RETORNO      : View de atualizacao de dados
     */
	public function settingsPersonalData(){

        // Se nao tiver nenhum usuario autenticado, 
        // é redirecionado para a rota de login
        if(Controller::isAuthenticated()){
			return view('user.settingsPersonalData', ["user" => Auth::user()]);
		}
		else
			return redirect()->route('user.login_get');

    }




    /**
     * FUNCAO       : settingsAuthData
     * OBJETIVO     : Exibir formulario de alterar dados de autenticacao
     * RETORNO      : View de atualizacao de dados de login
     */
	public function settingsAuthData(){

		// Se nao tiver nenhum usuario autenticado, 
        // é redirecionado para a rota de login
		if(Controller::isAuthenticated()){
			return view('user.settingsAuthData', ["user" => Auth::user()]);
		}
		else
			return redirect()->route('user.login_get');

    }




    /**
     * FUNCAO       :updatingPersonalData
     * OBJETIVO     :Encaminhar os dados pessoais para atualizacao
     * PARAMETROS   :Dados para atualizar
     * RETORNO      :Array indicando se houve erro ou falha
     */
	public function updatingPersonalData(UserUpdateRequest $request){

        $request = $this->service->updatePersonalData($request->all(), Auth::user()->id);             // Chamando o serviço de atualizacao de dados

        // O usuario sendo cadastrado com sucesso, ou nao,
        // os dados referentes são enviados para a view
		if($request['success']){
			// Decodifica em json para envio
            echo json_encode($request);             
			return;
		}
		else{
            echo json_encode($request);
            return;
		}
		
    }




    /**
     * FUNCAO       :updatingAuthData
     * OBJETIVO     :Encaminhar os dados pessoais para atualizacao
     * PARAMETROS   :Dados para atualizar
     * RETORNO      :Array indicando se houve erro ou falha
     */
	public function updatingAuthData(UserUpdateRequest $request){

		$request = $this->service->updateAuthData($request->all(), Auth::user()->id);             // Chamando o serviço de atualizacao de dados
        
        // O feedback da operacado de atualizacão é enviado para a view
		echo json_encode($request);
		return;
	
	}



	/**
     * FUNCAO       :settingsDelete
     * OBJETIVO     :Direcionar o usuario para a pagina de exclusao
     * RETORNO      :view da pagina de exclusao ou a pagina de login
     */
	public function settingsDelete(){

		// Se nao tiver nenhum usuario autenticado, 
		// é redirecionado para a rota de login
		if(Controller::isAuthenticated()){
			return view('user.settingsDelete', ["user" => Auth::user()]);
		}
		else
			return redirect()->route('user.login_get');

	}



	public function show($id){
        $user = $this->repository->find($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $user,
            ]);
        }
        return view('users.show', compact('user'));
	}
	



	/**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $user = $this->repository->find($id);
        return view('users.edit', compact('user'));
	}
	
	
	/**
     * FUNCAO       :deleteUser
     * OBJETIVO     :Encaminhar os dados pessoais para exclusao
     * RETORNO      :Retorna array com o resultado da operacao de exclusao
     */
	public function deleteUser(UserUpdateRequest $request){
	
		// Cria array com os dados do usuario a ser excluido e ...
		$dataUser = [
			"password" => $request->all()["password"],
			"id" => Auth::user()->id
		];

		// ... envia esses dados para exclusao
		$answer = $this->service->delete($dataUser);
		

		// Se a exclusao ocorrer sem erros, o usuario é deslogado automaticamente
		if($answer['success']){
			Auth::logout();
		}
		
		echo json_encode($answer);
		return;
	}



	/**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
		
        /*$deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

		return redirect()->back()->with('message', 'User deleted.');*/
		//return view('user.register');

	}
	
}
