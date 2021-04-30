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

3) `Prokl\BitrixModelBundle\Services\Factories\D7ModelFactory`

Методы:

- `getModel(string $dataClass)` - отдает модель по классу сущности  


## Фасады

Если установлен [бандл](https://github.com/ProklUng/facade.bundle), то автоматически устанавливаются два фасада:

- `ModelElementFacade`
- `ModelSectionFacade`
- `D7ModelFacade`

