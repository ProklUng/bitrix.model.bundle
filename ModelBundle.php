<?php

namespace Prokl\BitrixModelBundle;

use Prokl\BitrixModelBundle\DependencyInjection\CompilerPass\AddModelsIblockPass;
use Prokl\BitrixModelBundle\DependencyInjection\ModelExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ModelBundle
 * @package Prokl\BitrixModelBundle
 *
 * @since 30.01.2021
 */
class ModelBundle extends Bundle
{
   /**
   * @inheritDoc
   */
    public function getContainerExtension()
    {
        if ($this->extension === null) {
            $this->extension = new ModelExtension();
        }

        return $this->extension;
    }

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddModelsIblockPass());
    }
}
