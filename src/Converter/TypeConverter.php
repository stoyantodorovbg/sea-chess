<?php

namespace App\Converter;

use App\Converter\Interfaces\ConverterInterface;
use App\Converter\Interfaces\TypeConverterInterface;
use DateTime;
use DateTimeImmutable;

class TypeConverter implements ConverterInterface, TypeConverterInterface
{
    public function convert(mixed $value, array $configurations): mixed
    {
        foreach($configurations as $conversion) {
            $method = "from{$conversion['from']}To{$conversion['to']}";
            $value = $this->$method($value, $conversion['attributes'] ?? null);
        }

        return $value;
    }

    public function fromDateTimeImmutableToDateTime(DateTimeImmutable $input): DateTime
    {
        return DateTime::createFromImmutable($input);
    }

    public function fromDateTimeToString(DateTime $input, array $attributes): string
    {
        return $input->format($attributes['format']);
    }
}