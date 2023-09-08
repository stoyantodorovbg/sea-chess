<?php

namespace App\Converter;

class ScoreEntityConverter extends BaseEntityIterableConverter
{
    protected array $entityFields = [
        'type' => [],
        'value' => [],
        'createdAt' => [
            [
                'from' => 'DateTimeImmutable',
                'to'   => 'DateTime',
            ],
            [
                'from'       => 'DateTime',
                'to'         => 'string',
                'attributes' => ['format' => 'Y-m-d H:i:s']
            ],
        ],
    ];
}