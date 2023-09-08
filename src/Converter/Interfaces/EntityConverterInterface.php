<?php

namespace App\Converter\Interfaces;

interface EntityConverterInterface
{
    /**
     * @param array $fields
     * @return void
     */
    public function setEntityFields(array $fields): void;

    /**
     * @param object $entity
     * @return array
     */
    public function entityToArray(object $entity): array;
}