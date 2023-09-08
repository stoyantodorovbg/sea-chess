<?php

namespace App\Action;

use App\Entity\Score;
use App\Repository\Interfaces\ScoreRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

readonly class ScoreAction
{
    public function __construct(
        protected ScoreRepositoryInterface $scoreRepo,
    ) {}

    public function updateOrCreate(UserInterface $user, string $type, string|null $createdAt = null, int $value = 0): Score
    {
        if ($score = $this->scoreRepo->getScore($user, $type, $createdAt)) {
            return $this->scoreRepo->updateValue($score, $value);
        }

        return $this->scoreRepo->createScore($user, $type, $value);
    }

    public function getValue(UserInterface $user, string $type, string $createdAt = ''): int
    {
        $score = $this->scoreRepo->getScore($user, $type, $createdAt) ?? $this->scoreRepo->createScore($user, $type, 0);

        return $score->getValue();
    }

    public function getUserScores(UserInterface $user, string $type = null): array
    {
        return $this->scoreRepo->getScores($user, $type);
    }
}