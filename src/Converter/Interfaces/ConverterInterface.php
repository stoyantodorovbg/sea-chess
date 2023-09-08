<?php

namespace App\Converter\Interfaces;

interface ConverterInterface
{
    /**
     * @param mixed $value
     * @param array $configurations
     * @return mixed
     */
    public function convert(mixed $value, array $configurations): mixed;
}