<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    public $timestamps = true;          // Gerencia as datas de exclusao, edicao, criacao...

    protected $table = 'users';         // nome da tabela
    
    protected $fillable = ['name','username','password','email','sexo','phone','dataNasc',];

    protected $hidden = ['password', 'remember_token',];

    public function setPasswordAttribute($pPassword){
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($pPassword) : $pPassword;
        //$this->attributes['password'] = bcrypt($pSenha);
    }
}
