<?php

namespace Prokl\BitrixModelBundle\DependencyInjection;

use Arrilot\BitrixModels\Models\ElementModel;
use Arrilot\BitrixModels\Models\SectionModel;
use Exception;
use LogicException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class ModelExtension
 * @package Local\Bundles\Model\DependencyInjection
 *
 * @since 30.01.2021
 */
class ModelExtension extends Extension
{
    private const DIR_CONFIG = '/../Resources/config';

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container) : void
    {
        $this->checkDependency();

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('bitrix-model.ttl_cache', $config['ttl_cache']);
        $container->setParameter('bitrix-model.cache_dir', $config['cache_dir']);
        $container->setParameter('bitrix-model.proxy_cache_dir', $config['proxy_cache_dir']);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . self::DIR_CONFIG)
        );

        $loader->load('services.yaml');
        $loader->load('caching.yaml');

        // Фасады подтягиваются только, если установлен соответствующий бандл.
        if (class_exists('Prokl\FacadeBundle\Services\AbstractFacade')) {
            $loader->load('facades.yaml');
        }
    }

    /**
     * @inheritDoc
     */
    public function getAlias() : string
    {
        return 'bitrix-model';
    }

    /**
     * Проверка на существование в системе пакета моделей.
     *
     * @return void
     * @throws LogicException
     */
    private function checkDependency() : void
    {
        if (!class_exists(ElementModel::class) || !class_exists(SectionModel::class)) {
            throw new LogicException(
                'ModelBundle work only with installed and configured Arrilot Models package.'
            );
        }
    }
}
