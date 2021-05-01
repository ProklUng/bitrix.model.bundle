<?php

namespace Prokl\BitrixModelBundle\Services\Traits;

/**
 * Trait CacheTrait
 * @package Prokl\BitrixModelBundle\Services\Traits
 *
 * @since 01.05.2021
 */
trait CacheTrait
{
    /**
     * Нормализация ключа кэша.
     *
     * @param string $src
     *
     * @return string
     */
    private function getCacheKey(string $src) : string
    {
        return  str_replace(
            ['{', '}', '\\', '@', '/', ':'],
            '',
            $src
        );
    }
}