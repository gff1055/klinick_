<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Doctor;

/**
 * Class DoctorTransformer.
 *
 * @package namespace App\Transformers;
 */
class DoctorTransformer extends TransformerAbstract
{
    /**
     * Transform the Doctor entity.
     *
     * @param \App\Entities\Doctor $model
     *
     * @return array
     */
    public function transform(Doctor $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
