<?php

namespace App\Converter;

use App\Converter\Interfaces\IterableConverterInterface;
use App\Converter\Interfaces\EntityConverterInterface;
use App\Converter\Interfaces\TypeConverterInterface;

abstract class BaseEntityIterableConverter implements EntityConverterInterface, IterableConverterInterface
{
    protected array $entityFields = [];

    public function __construct(protected TypeConverterInterface $typeConverter)
    {
    }

    public function setEntityFields(array $fields): void
    {
        $this->entityFields = $fields;
    }

    public function entityToArray(object $entity): array
    {
        $converted = [];
        foreach ($this->entityFields as $field => $configurations) {
            $getter = 'get' . strtoupper($field);
            $converted[$field] = $this->typeConverter->convert(
                value: $entity->$getter(),
                configurations: $configurations,
            );
        }

        return $converted;
    }

    public function iterableToArray(
        iterable $iterable,
        string $itemConversionType = 'entityToArray',
        string $convertTo = 'toArray'
    ): array
    {
        $converted = [];

        foreach ($iterable as $item) {
            $converted[] = $this->$itemConversionType($item);
        }

        return $converted;
    }
}