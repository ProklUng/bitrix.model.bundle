<?php

namespace Prokl\BitrixModelBundle\Services\Utils;

/**
 * Class EnvironmentResolver
 * @package Prokl\BitrixModelBundle\Services\Utils
 *
 * @since 02.05.2021
 */
class EnvironmentResolver
{
    /**
     * @var string $env
     */
    private $env;

    /**
     * EnvironmentResolver constructor.
     *
     * @param boolean $env
     */
    public function __construct(bool $env)
    {
        $this->env = $env ? 'dev' : 'prod';
    }

    /**
     * @return string
     */
    public function getEnv(): string
    {
        return $this->env;
    }
}