<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Doctor.
 *
 * @package namespace App\Entities;
 */
class Doctor extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['user_id','registeredName', 'numberCrm', 'nameSpecialty1', 'numberRqe1', 'nameSpecialty2', 'numberRqe2','nameSpecialty3', 'numberRqe3', 'description'];
	public $timestamps = true;          // Gerencia as datas de exclusao, edicao, criacao...
	

}
