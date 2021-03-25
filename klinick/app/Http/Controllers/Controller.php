<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

 /*   public function userHome(){
        if(Auth::check() === true){
            
            //dd(Auth::user());
            return redirect()->route('user.index');    
        }
        else{
            return redirect()->route('user.login_get');
        }
    }*/

    public function userLogin(){
        return view('user.login');
    }

    public function doctorLogin(){
        return view('doctor.login');
    }

    public function mainPage(){
        return view('main.page');
    }


}
