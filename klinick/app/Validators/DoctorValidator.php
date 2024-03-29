<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class DoctorValidator.
 *
 * @package namespace App\Validators;
 */
class DoctorValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
			'user_id' => 'required',
            'registeredName' => 'required',
            'numberCrm' => 'required',
		],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
