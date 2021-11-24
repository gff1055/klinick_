<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct(UserRepository $repository, UserValidator $validator){
        $this->repository = $repository;
        $this->validator = $validator;
    }
    
    
    /**
     * FUNCAO:      login 
     * OBJETIVO:    Efetuar o login
     * ARGUMENTOS:  Os dados que contidos nos campos 'nome de usuario' e 'senha'
     * RETORNO:     Um ARRAY com os seguintes dados
     *                  'success' -> indica se houve falha ou sucesso no login
     *                  'message' -> mensagem explicando o motivo do erro/excecao
     */
    
    public function login(Request $dadosLogin){

        // recebendo dados inseridos pelo usuario
        $dadosAut = [
            'email' => $dadosLogin->get('username'),
            'password' => $dadosLogin->get('password')
        ];


        // Efetuando login
        try{
        
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

        /* Quando houver uma excecao, ela será mostrada na view */
        catch(Exception $e){
            return $e->getMessage();
        }
    }


	/**
     * FUNCAO:		userLogin
     * OBJETIVO:	Verifica se o usuario atual está logado
     * RETORNO:		view de login ou index
     */
	public function userLogin(){

		// Se o usuario não estiver logado, é exibida a view de login
		if(!Auth::check()){
			return view('user.login');
		}

		// Se o usuario já estiver logado, é redirecionado para a pagina inicial
		else{
			return redirect()->route('user.index');
		}
    }

    /**
     * FUNCAO:          Logout
     * OBJETIVO:        Encerrar a sessao do usuario corrente
     * RETORNO:         Rota inicial de login
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('user.login_get'); // MANDA O USUARIO PARA A ROTA APOS o logout
	}
	

	public function deactivated(){
		return view('user.deactivate');
    }
}
