<?php

namespace App\Action;

use App\Entity\Score;
use App\Repository\Interfaces\ScoreRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;

readonly class ScoreAction
{
    public function __construct(
        protected ScoreRepositoryInterface $scoreRepo,
        protected UserRepositoryInterface $userRepo,
    ) {}

    public function updateOrCreate(
        int $userId,
        string $type,
        string $createdAt = '',
        int $value = 0,
    ): Score
    {
        $user = $this->userRepo->getUser($userId);

        if ($score = $this->scoreRepo->getScore($user, $type, $createdAt)) {
            return $this->scoreRepo->updateValue($score, $value);
        }

        return $this->scoreRepo->createScore($user, $type, $value);
    }

    public function getValue(int $userId, string $type, string $createdAt = ''): int
    {
        $user = $this->userRepo->getUser($userId);

        $score = $this->scoreRepo->getScore($user, $type, $createdAt) ?? $this->scoreRepo->createScore($user, $type, 0);

        return $score->getValue();
    }

    public function getUserScores(int $userId, string $type = null): array
    {
        $user = $this->userRepo->getUser($userId);

        return $this->scoreRepo->getScores($user, $type);
    }
}