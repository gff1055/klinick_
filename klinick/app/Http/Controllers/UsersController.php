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
    
    public function login(Request $dadosLogin){

        /*var_dump($dadosLogin->all());*/

        // recebendo dados inseridos pelo usuario
        $dadosAut = [
            'email' => $dadosLogin->get('username'),
            'password' => $dadosLogin->get('password')
        ];

        

         //var_dump($dadosAut);

/*        if(Auth::login($dadosAut));
        else{
            echo 'aconteceu algo';
        }*/

//        var_dump(Auth::check());



        // Efetuando login
        try
        {
        
            // Se a criptografia de senha esta habilitada
            // é executado o metodo especifico

            if(env('PASSWORD_HASH')){
                Auth::attempt($dadosAut, false);
            }

            // A criptografia de senha nao esta habilitada
            else
            {
                $user = $this->repository->findWhere(['email' => $dadosLogin->get('username')])->first();
                

                // O usuario existe?
                if(!$user)
                    throw new Exception("Email/Login invalido");
                
                // A senha esta correta?
                if($user->password != $dadosLogin->get('password'))
                    throw new Exception("SENHA INVALIDA");

//*                $databaseData = DB::select('select * from users where username = ? or email = ?', [$dadosLogin->get('username'), $dadosLogin->get('username')]);*/
              
                /* Se o usuario nao existe,
                a operacao é sinalizada como false e é enviado mensagem para a view */
//*                if(!$databaseData){

//*                    throw new Exception("Email/Login invalido");

                    // COM JAVASCRIPT
                    /*$loginFeedback['success'] = false;
                    $loginFeedback['message'] = "O Email/Login nao existe";
                    
                    echo json_encode($loginFeedback);
                    return;*/
                
//*                }

                /* Se o usuario existir, os dados do mesmo sao carregados */
//*                else{

//*                    $user = new User();
//*                    $user->loadDataLogin($databaseData[0]);

                    /* Se a senha informada for diferente da cadastrada é enviado
                    o alerta para a view*/
//*                    if($user->password != $dadosLogin->get('password')){

//*                        throw new Exception("sENHA INVALIDA");
                    
                        // COM JAVASCRIPT
                        /*$loginFeedback['success'] = false;
                        $loginFeedback['message'] = "Senha invalida";
                    
                        echo json_encode($loginFeedback);
                        return;*/
                    
//*                    }
                
//*                }

                Auth::login($user);
                /*if(Auth::login($user))
                echo 'nada';
                else{
                    echo 'aconteceu algo';
                }*/
            }

            return redirect()->route('user.index');
            /*$loginFeedback['success'] = true;
            $loginFeedback['check'] = Auth::check();
            // echo Auth::user();
            
            echo json_encode($loginFeedback);
            return;*/
        
        }

        /* Quando houver uma excecao, ela será mostrada na view */
        catch(Exception $e){
        
//*            $loginFeedback['success'] = false;
//*            $loginFeedback['message'] = $e->getMessage();
        
//*            echo json_encode($loginFeedback);
//*            return;
        
            return $e->getMessage();
        }
    
    }




    /**
     * FUNCAO:      register
     * OBJETIVO:    acionar a view para cadastro de novo usuario
     * RETORNO:     view propriamente dita
     */
    public function register(){
    
        return view('user.register');
    
    }
    
    
    
    
    public function index(){
        /*if(Auth::check() == true){
            echo "logado";
        }
        else if(Auth::check() == false){
            echo "nao logado";
        }
        else{
            echo "algo errado";
        }*/
//*     return view('user.index');
        echo "HAAAA";

        if(Auth::check() == true){
            echo "logado";
        }

        dd(Auth::user());



            
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
        if($request['success']){

            /*echo json_encode($request);
            return;*/
            $user = $request['data'];
        }

        else{
            /*echo json_encode($request);
            return;*/
            $user = null;
        }


        $user = $this->repository->findWhere(['email' => $registeredData['email']])->first();
        //dd($user);
        Auth::login($user);
        return redirect()->route('user.index');

        /*return view('user.index',[
            'user' => $user,
//            'request' => $request
        ]);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
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
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id){
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }
}
