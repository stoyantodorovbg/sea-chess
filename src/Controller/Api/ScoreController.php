<?php

namespace App\Controller\Api;

use App\Action\ScoreAction;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ScoreController
{
    #[Route('/api/get-score', methods: ['GET'])]
    public function getUserScore(Request $request, ScoreAction $action): JsonResponse
    {
        return new JsonResponse([
            'score' => $action->getValue(
                userId: $request->get('user_id'),
                type: $request->get('type'),
                createdAt: $request->get('created_at'),
            ),
        ]);
    }

    #[Route('/api/get-scores', methods: ['GET'])]
    public function getUserScores(Request $request, ScoreAction $action): JsonResponse
    {
        return new JsonResponse([
            'scores' => $action->getUserScores(
                userId: $request->get('user_id'),
                type: $request->get('type'),
            ),
        ]);
    }

    #[Route('/api/set-score', methods: ['POST'])]
    public function setScore(Request $request, ScoreAction $action): JsonResponse
    {
        $action->updateOrCreate(
            userId: $request->get('user_id'),
            type: $request->get('type'),
            createdAt: $request->get('created_at'),
            value: $request->get('value'),
        );

        return new JsonResponse(['message' => 'Success']);
    }
}