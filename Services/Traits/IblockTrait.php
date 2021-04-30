<?php

namespace Prokl\BitrixModelBundle\Services\Traits;

use Bitrix\Main\ArgumentException;
use CIBlock;

/**
 * Trait IblockTrait
 * @package Prokl\BitrixModelBundle\Services\Traits
 *
 * @since 30.04.2021
 */
trait IblockTrait
{
    /** ID инфоблока по коду.
     *
     * @param string $iblockType Тип инфоблока.
     * @param string $iblockCode Код инфоблока.
     *
     * @return integer
     *
     * @throws ArgumentException
     */
    public function getIBlockIdByCode(string $iblockType, string $iblockCode) : int
    {
        $res = CIBlock::GetList(
            [],
            ['ACTIVE' => 'Y', 'TYPE' => $iblockType, 'CODE' => $iblockCode]
        );
        $arResult = $res->Fetch();
        if ($arResult['ID'] > 0) {
            return (int)$arResult['ID'];
        }

        throw new ArgumentException('Инфоблок '.$iblockCode.' не найден', $iblockCode);
    }
}
