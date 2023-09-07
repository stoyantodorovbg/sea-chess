<?php

namespace App\Enum;


enum ScoreType: string
{
    case SINGLE_PLAYER_GAME = 'single player game';

    /**
     * @throws \Exception
     */
    public static function make(string $input): self
    {
        return match ($input) {
            'single player game' => self::SINGLE_PLAYER_GAME,
            default => throw new \Exception(message: 'Invalid value sent to ScoreType enum.', code: 422),
        };
    }
}