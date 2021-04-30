<?php

namespace Prokl\BitrixModelBundle\Services\Facades;

use Prokl\FacadeBundle\Services\AbstractFacade;

/**
 * Class D7ModelFacade
 * @package Prokl\BitrixModelBundle\Services\Facades
 *
 * @since 30.04.2021
 *
 * @method static getModel(string $dataClass)
 */
class D7ModelFacade extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor() : string
    {
        return 'model_bundle.d7_model';
    }
}
