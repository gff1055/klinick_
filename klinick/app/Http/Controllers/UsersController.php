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
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;

class UsersController extends Controller{
    
    protected $repository;
    protected $service;
    
    //reformulacao
    //protected $validator;

    public function __construct(UserRepository $repository, UserService $service){
        $this->repository = $repository;
        $this->service = $service;
    }




    /**
     * FUNCAO:      login 
     * OBJETIVO:    Efetuar o login
     * ARGUMENTOS:  Os dados que contidos nos campos 'nome de usuario' e 'senha'
     * RETORNO:     Um ARRAY com os seguintes dados
     *                  'success' -> indica se houve falha ou sucesso no login
     *                  'message' -> mensagem explicando o motivo do erro/excecao
     */
    
/*    public function login(Request $dadosLogin){

        // recebendo dados inseridos pelo usuario
        $dadosAut = [
            'email' => $dadosLogin->get('username'),
            'password' => $dadosLogin->get('password')
        ];


        // Efetuando login
        try {
        
            // Se a criptografia de senha esta habilitada
            // é executado o metodo especifico
            if(env('PASSWORD_HASH')){
                Auth::attempt($dadosAut, false);
            }

            // A criptografia de senha nao esta habilitada
            else{
                $user = $this->repository->findWhere(['email' => $dadosLogin->get('username')])->first();
                   
                // Se o usuario nao existir é enviado um alerta
                if(!$user){
                    //A variavel '$loginFeedback' armazena o status da requisicao se houve sucesso/erro
                    $loginFeedback['success'] = false;
                    $loginFeedback['message'] = "O Email/Login nao existe";
                    echo json_encode($loginFeedback);                   // Converte a variavel '$loginFeedback' em JSON
                    return;
                }
                
                // Se a senha não for compativel é enviado um alerta
                if($user->password != $dadosLogin->get('password')){
                    $loginFeedback['success'] = false;
                    $loginFeedback['message'] = "Senha invalida";
                    echo json_encode($loginFeedback);                   // Converte a variavel '$loginFeedback' em JSON
                    return;
                    //throw new Exception("SENHA INVALIDA");
                }
                
                Auth::login($user);
                $loginFeedback['success'] = true;
                echo json_encode($loginFeedback);                   // Converte a variavel '$loginFeedback' em JSON
                return;
            }

        }

        // Quando houver uma excecao, ela será mostrada na view 
        catch(Exception $e){
            return $e->getMessage();
        }
    }
*/



    /**
     * FUNCAO:          Logout
     * OBJETIVO:        Encerrar a sessao do usuario corrente
     */
/*    public function logout(){
        Auth::logout();
        return redirect()->route('user.login_get'); // MANDA O USUARIO PARA A ROTA APOS o logout
    }*/




    /**
     * FUNCAO:      register
     * OBJETIVO:    acionar a view para cadastro de novo usuario
     * RETORNO:     view propriamente dita
     */
    public function register(){
        return view('user.register');
    }
    
    
    
    
    public function index(){
    
        // Se nao tiver nenhum usuario autenticado, 
        // é redirecionado para a rota de login
        if(!Auth::check())
            return redirect()->route('user.login_get');
        
        // Se tiver alguem autenticado,
        // é redirecionado para a rota do usuario 
        $nameTemp = Auth::user()->name;
        return view('user.index', ["name" => $nameTemp]);
            
    }




    /**
     * FUNCAO:      store
     * OBJETIVO:    Cadastrar o usuario
     * ARGUMENTOS:  Dados do usuario
     * RETORNO:     Dados necessarios para avaliar se houve falha ou nao no cadastro
     */
    public function store(UserCreateRequest $request){
        $registeredData = $request;
        $request = $this->service->store($request->all());

        // O usuario sendo cadastrado com sucesso, ou nao,
        // os dados referentes são enviados para a view
        if($request[0]['success']){
            Auth::login($request[0]['data']);       // Efetua login do usuario recem cadastrado no sistema
            echo json_encode($request);             // Decodifica em json
            return;
            //$user = $request['data'];
        }

        else{
            echo json_encode($request);
            return;
            //$user = null;
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
        if(!Auth::check())
            return redirect()->route('user.login_get');
        else
            return view('user.settingsPersonalData', ["user" => Auth::user()]);
    }


    /**
     * FUNCAO       : settingsAuthData
     * OBJETIVO     : Exibir formulario de alterar dados de autenticacao
     * RETORNO      : View de atualizacao de dados de login
     */
    public function settingsAuthData(){
        // Se nao tiver nenhum usuario autenticado, 
        // é redirecionado para a rota de login
        if(!Auth::check())
            return redirect()->route('user.login_get');
        else
            return view('user.settingsAuthData', ["user" => Auth::user()]);
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
     * FUNCAO       :updatePersonalData
     * OBJETIVO     :Encaminhar os dados pessoais para atualizacao
     * PARAMETROS   :Dados para atualizar
     * RETORNO      :Array indicando se houve erro ou falha
     */
    public function updatePersonalData(UserUpdateRequest $request){
        
        define('DATA_PERSONAL',2);
        define('PASSWORD',1);
                
        $request = $this->service->update($request->all(), DATA_PERSONAL, Auth::user()->id);             // Chamando o serviço de atualizacao de dados
        //dd($request);

        // O usuario sendo cadastrado com sucesso, ou nao,
        // os dados referentes são enviados para a view
        if($request['success']){
            echo json_encode($request);             // Decodifica em json para envio
            return;
            //$user = $request['data'];
        }

        else{
            echo json_encode($request);
            return;
            //$user = null;
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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }
}
