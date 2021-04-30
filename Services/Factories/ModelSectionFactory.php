<?php

namespace Prokl\BitrixModelBundle\Services\Factories;

use Arrilot\BitrixModels\Models\SectionModel;
use CIBlockSection;
use LogicException;
use Prokl\BitrixModelBundle\Services\Traits\IblockTrait;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * Class ModelSectionFactory
 * @package Prokl\BitrixModelBundle\Services\Factories
 *
 * @since 30.01.2021
 */
class ModelSectionFactory
{
    use IblockTrait;

    /**
     * @var ServiceLocator $modelLocator Сервисы, помеченные в контейнере тэгом iblock.model.
     */
    private $modelLocator;

    /**
     * @var CIBlockSection $blockSection Битриксовый CIBlockSection.
     */
    private $blockSection;

    /**
     * ModelSectionFactory constructor.
     *
     * @param ServiceLocator $locator      Сервисы, помеченные в контейнере тэгом iblock.model.
     * @param CIBlockSection $blockSection Битриксовый CIBlockSection.
     */
    public function __construct(
        ServiceLocator $locator,
        CIBlockSection $blockSection
    ) {
        $this->modelLocator = $locator;
        $this->blockSection = $blockSection;
    }

    /**
     * Модель по ID подраздела.
     *
     * @param integer $idSection ID подраздела.
     *
     * @return SectionModel
     * @throws LogicException
     */
    public function getModel(int $idSection) : SectionModel
    {
        $iblockId = $this->getIblockId($idSection);

        return $this->getModelByIdIblock($iblockId);
    }

    /**
     * Модель по коду и типу инфоблока.
     *
     * @param string $iblockType Тип инфоблока.
     * @param string $iblockCode Код инфоблока.
     *
     * @return SectionModel
     */
    public function getModelByCodeIblock(string $iblockType, string $iblockCode) : SectionModel
    {
        $iblockId = $this->getIBlockIdByCode($iblockType, $iblockCode);

        return $this->getModelByIdIblock($iblockId);
    }

    /**
     * Модель по ID инфоблока.
     *
     * @param integer $iblockId ID инфоблока.
     *
     * @return SectionModel
     * @throws LogicException
     */
    public function getModelByIdIblock(int $iblockId) : SectionModel
    {
        if ($iblockId !== 0) {
            foreach ($this->modelLocator->getProvidedServices() as $serviceId => $value) {
                $service = $this->modelLocator->get($serviceId);
                if ($service::IBLOCK_ID === $iblockId) {
                    return $service;
                }
            }
        }

        throw new LogicException(
            'Model not found.'
        );
    }

    /**
     * ID инфоблока по ID подраздела.
     *
     * @param integer $idSection ID подраздела.
     *
     * @return integer
     */
    private function getIblockId(int $idSection) : int
    {
        $result = $this->blockSection::GetList(
            [],
            ['ID' => $idSection],
            false,
            ['IBLOCK_ID']
        );

        if ($data = $result->Fetch()) {
            return (int)$data['IBLOCK_ID'];
        }

        return 0;
    }
}
