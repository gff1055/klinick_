<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\medFormRepository;
use App\Entities\MedForm;
use App\Validators\MedFormValidator;

/**
 * Class MedFormRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MedFormRepositoryEloquent extends BaseRepository implements MedFormRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MedForm::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MedFormValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
