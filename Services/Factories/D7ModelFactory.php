<?php

namespace Prokl\BitrixModelBundle\Services\Factories;

use Arrilot\BitrixModels\Models\D7Model;
use LogicException;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * Class D7ModelFactory
 * @package Prokl\BitrixModelBundle\Services\Factories
 *
 * @since 30.04.2021
 */
class D7ModelFactory
{
    /**
     * @var ServiceLocator $modelLocator Сервисы, помеченные в контейнере тэгом d7.model.
     */
    private $modelLocator;

    /**
     * D7ModelFactory constructor.
     *
     * @param ServiceLocator $locator Сервисы, помеченные в контейнере тэгом d7.model.
     */
    public function __construct(ServiceLocator $locator) {
        $this->modelLocator = $locator;
    }

    /**
     * Модель по классу сущности.
     *
     * @param string $dataClass Класс сущности.
     *
     * @return D7Model
     */
    public function getModel(string $dataClass) : D7Model
    {
        foreach ($this->modelLocator->getProvidedServices() as $serviceId => $value) {
            $service = $this->modelLocator->get($serviceId);
            if ($service::tableClass() === $dataClass) {
                return $service;
            }
        }

        throw new LogicException(
            'D7 model for class ' . $dataClass . 'not found.'
        );
    }
}
