<?php

namespace App\Converter\Interfaces;

use DateTime;
use DateTimeImmutable;

interface TypeConverterInterface
{
    /**
     * @param DateTimeImmutable $input
     * @return DateTime
     */
    public function fromDateTimeImmutableToDateTime(DateTimeImmutable $input): DateTime;

    /**
     * @param DateTime $input
     * @param array    $parameters
     * @return string
     */
    public function fromDateTimeToString(DateTime $input, array $parameters): string;
}