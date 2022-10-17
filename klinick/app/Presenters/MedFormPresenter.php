<?php

namespace App\Presenters;

use App\Transformers\MedFormTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MedFormPresenter.
 *
 * @package namespace App\Presenters;
 */
class MedFormPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MedFormTransformer();
    }
}
