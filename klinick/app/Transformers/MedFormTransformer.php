<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MedForm;

/**
 * Class MedFormTransformer.
 *
 * @package namespace App\Transformers;
 */
class MedFormTransformer extends TransformerAbstract
{
    /**
     * Transform the MedForm entity.
     *
     * @param \App\Entities\MedForm $model
     *
     * @return array
     */
    public function transform(MedForm $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
