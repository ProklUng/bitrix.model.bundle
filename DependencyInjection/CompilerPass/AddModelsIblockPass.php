<?php

namespace Prokl\BitrixModelBundle\DependencyInjection\CompilerPass;

use Arrilot\BitrixModels\Models\D7Model;
use Arrilot\BitrixModels\Models\ElementModel;
use Arrilot\BitrixModels\Models\SectionModel;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AddModelsIblockPass
 * @package Prokl\BitrixModelBundle\DependencyInjection\CompilerPass
 *
 * @since 30.01.2021
 */
final class AddModelsIblockPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container) : void
    {
        foreach ($container->getDefinitions() as $definition) {
            $class = $definition->getClass();
            if (is_subclass_of($class, ElementModel::class)) {
                $definition->addTag(
                    'iblock.element.model',
                    ['key' => $class]
                );
            }

            if (is_subclass_of($class, SectionModel::class)) {
                $definition->addTag(
                    'iblock.section.model',
                    ['key' => $class]
                );
            }

            if (is_subclass_of($class, D7Model::class)) {
                $definition->addTag(
                    'd7.model',
                    ['key' => $class]
                );
            }
        }
    }
}
