<?php

namespace Prokl\BitrixModelBundle\Services\Facades;

use Prokl\FacadeBundle\Services\AbstractFacade;

/**
 * Class ModelElementFacade
 * @package Prokl\BitrixModelBundle\Services\Facades
 *
 * @since 02.05.2021
 *
 * @method static getModel(int $idElement)
 * @method static getModelByIdIblock(int $iblockId)
 * @method static getModelByCodeIblock(string $iblockType, string $iblockCode)
 */
class ModelElementFacadeCached extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor() : string
    {
        return 'model_bundle.factory_elements_cached';
    }
}
