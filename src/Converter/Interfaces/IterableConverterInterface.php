<?php

namespace App\Converter\Interfaces;

interface IterableConverterInterface
{
    /**
     * @param iterable $iterable
     * @param string   $itemConversionType
     * @param string   $convertTo
     * @return array
     */
    public function iterableToArray(
        iterable $iterable,
        string $itemConversionType,
        string $convertTo = 'toArray'
    ): array;
}