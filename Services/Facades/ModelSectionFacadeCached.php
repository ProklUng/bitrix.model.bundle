<?php

namespace Prokl\BitrixModelBundle\Services\Facades;

use Prokl\FacadeBundle\Services\AbstractFacade;

/**
 * Class ModelSectionFacadeCached
 * @package Prokl\BitrixModelBundle\Services\Facades
 *
 * @since 02.05.2021
 *
 * @method static getModel(int $idElement)
 * @method static getModelByIdIblock(int $iblockId)
 * @method static getModelByCodeIblock(string $iblockType, string $iblockCode)
 */
class ModelSectionFacadeCached extends AbstractFacade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor() : string
    {
        return 'model_bundle.factory_sections';
    }
}
