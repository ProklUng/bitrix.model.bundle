# Бандл для Битрикс + Symfony для обращения с моделями инфоблоков

Под моделями подразумевается то, что предоставляется [пакетом](https://github.com/arrilot/bitrix-models).

## Установка

`composer require proklung/bitrix-model-bundle`

## Использование

Все сервисы, наследующиеся от `Arrilot\BitrixModels\Models\ElementModel` или `Arrilot\BitrixModels\Models\SectionModel`
автоматически регистрируются в качестве моделей.

Два основных сервиса:

1) `Prokl\BitrixModelBundle\Services\Factories\ModelElementFactory`

2) `Prokl\BitrixModelBundle\Services\Factories\ModelSectionFactory`

Методы:

- `getModel(int $id)` - отдает модель по ID элемента  
- `getModelByIdIblock(int $id)` - отдает модель по ID инфоблока  
