<?php

namespace App\Repository\Interfaces;

use App\Entity\Score;
use App\Entity\User;
use App\Enum\ScoreType;

interface ScoreRepositoryInterface
{
    /**
     * @param User      $user
     * @param ScoreType $type
     * @param int       $value
     * @return Score
     */
    public function store(User $user, ScoreType $type, int $value = 0): Score;

    /**
     * @param Score $score
     * @param int   $value
     * @return Score
     */
    public function updateValue(Score $score, int $value): Score;

    /**
     * @param User   $user
     * @param string $type
     * @param string $createdAt
     * @return Score|null
     */
    public function getScore(User $user, string $type, string $createdAt): Score|null;

    /**
     * @param User   $user
     * @param string $type
     * @param int    $value
     * @return Score
     */
    public function createScore(User $user, string $type, int $value): Score;
}