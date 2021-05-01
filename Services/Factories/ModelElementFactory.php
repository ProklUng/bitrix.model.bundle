<?php

namespace Prokl\BitrixModelBundle\Services\Factories;

use Arrilot\BitrixModels\Models\ElementModel;
use CIBlockElement;
use Exception;
use LogicException;
use Prokl\BitrixModelBundle\Services\Traits\IblockTrait;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class ModelElementFactory
 * @package Prokl\BitrixModelBundle\Services\Factories
 *
 * @since 30.01.2021
 */
class ModelElementFactory
{
    use IblockTrait;

    /**
     * @var ServiceLocator $modelLocator Сервисы, помеченные в контейнере тэгом iblock.model.
     */
    private $modelLocator;

    /**
     * @var CIBlockElement $blockElement Битриксовый CIBlockElement.
     */
    private $blockElement;

    /**
     * @var CacheInterface $cacher Кэшер.
     */
    private $cacher;

    /**
     * ModelElementFactory constructor.
     *
     * @param ServiceLocator $locator      Сервисы, помеченные в контейнере тэгом iblock.model.
     * @param CIBlockElement $blockElement Битриксовый CIBlockElement.
     * @param CacheInterface $cacher       Кэшер.
     */
    public function __construct(
        ServiceLocator $locator,
        CIBlockElement $blockElement,
        CacheInterface $cacher
    ) {
        $this->modelLocator = $locator;
        $this->blockElement = $blockElement;
        $this->cacher = $cacher;
    }

    /**
     * Модель по ID элемента.
     *
     * @param integer $idElement ID элемента.
     *
     * @return ElementModel
     * @throws LogicException
     */
    public function getModel(int $idElement) : ElementModel
    {
        $iblockId = $this->getIblockId($idElement);

        return $this->getModelByIdIblock($iblockId);
    }

    /**
     * Модель по ID элемента. С использованием кэша.
     *
     * @param integer $idElement ID элемента.
     *
     * @return ElementModel
     * @throws LogicException|InvalidArgumentException
     */
    public function getModelCached(int $idElement) : ElementModel
    {
        $keyCache = __CLASS__ . __METHOD__ . $idElement;
        $iblockId = $this->cacher->get(
            $keyCache,
            /**
             * @param CacheItemInterface $item
             * @return mixed
             */
            function (CacheItemInterface $item) use ($idElement) {
                return $this->getIblockId($idElement);
            }
        );

        return $this->getModelByIdIblock($iblockId);
    }

    /**
     * Модель по коду и типу инфоблока.
     *
     * @param string $iblockType Тип инфоблока.
     * @param string $iblockCode Код инфоблока.
     *
     * @return ElementModel
     */
    public function getModelByCodeIblock(string $iblockType, string $iblockCode) : ElementModel
    {
        $iblockId = $this->getIBlockIdByCode($iblockType, $iblockCode);

        return $this->getModelByIdIblock($iblockId);
    }

    /**
     * Модель по коду и типу инфоблока. Кэширование.
     *
     * @param string $iblockType Тип инфоблока.
     * @param string $iblockCode Код инфоблока.
     *
     * @return ElementModel
     * @throws InvalidArgumentException
     */
    public function getModelByCodeIblockCached(string $iblockType, string $iblockCode) : ElementModel
    {
        $keyCache = __CLASS__ . __METHOD__ . $iblockType . $iblockCode;
        $iblockId = $this->cacher->get(
            $keyCache,
            /**
             * @param CacheItemInterface $item
             * @return mixed
             */
            function (CacheItemInterface $item) use ($iblockType, $iblockCode) {
                return $this->getIBlockIdByCode($iblockType, $iblockCode);
            }
        );

        return $this->getModelByIdIblock($iblockId);
    }

    /**
     * Модель по ID инфоблока.
     *
     * @param integer $iblockId ID инфоблока.
     *
     * @return ElementModel
     * @throws LogicException
     */
    public function getModelByIdIblock(int $iblockId) : ElementModel
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
     * ID инфоблока по ID элемента.
     *
     * @param integer $idElement ID элемента.
     *
     * @return integer
     */
    private function getIblockId(int $idElement) : int
    {
        $result = $this->blockElement::GetList(
            [],
            ['ID' => $idElement],
            false,
            false,
            ['IBLOCK_ID']
        );

        if ($data = $result->Fetch()) {
            return (int)$data['IBLOCK_ID'];
        }

        return 0;
    }
}
