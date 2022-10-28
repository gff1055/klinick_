<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MedForm.
 *
 * @package namespace App\Entities;
 */
class MedForm extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	public $timestamps = true;          // Gerencia as datas de exclusao, edicao, criacao...



    protected $fillable = [
		'user_id',
		'date',
		'state',
		'city',
		'complaint',
		'paymentMode'
	];

	public function user(){
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

}
