<?php

namespace Prokl\BitrixModelBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Prokl\BitrixModelBundle\DependencyInjection
 */
final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder() : TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bitrix-model');
        $rootNode    = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('ttl_cache')->info('Время жизни кэша')->defaultValue(3600)->end()
                ->scalarNode('cache_dir')->info('Папка с кэшом')->defaultValue('%kernel.cache_dir%')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
