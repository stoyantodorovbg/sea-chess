<?php

namespace App\Controller\Api;

use App\Action\ScoreAction;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ScoreController extends AbstractController
{
    public function __construct(private Security $security)
    {
    }


    #[Route('/api/get-score', methods: ['GET'])]
    public function getUserScore(Request $request, ScoreAction $action): JsonResponse
    {
        return new JsonResponse([
            'score' => $action->getValue(
                user: $this->security->getUser(),
                type: $request->getPayload()->get('type'),
                createdAt: $request->getPayload()->get('created_at'),
            ),
        ]);
    }

    #[Route('/api/get-scores', methods: ['GET'])]
    public function getUserScores(Request $request, ScoreAction $action): JsonResponse
    {
        return new JsonResponse([
            'scores' => $action->getUserScores(
                user: $this->security->getUser(),
                type: $request->get('type'),
            ),
        ]);
    }

    #[Route('/api/set-score', methods: ['POST'])]
    public function setScore(Request $request, ScoreAction $action, LoggerInterface $logger): JsonResponse
    {
        $action->updateOrCreate(
            user: $this->security->getUser(),
            type: $request->getPayload()->get('type'),
            createdAt: $request->getPayload()->get('created_at'),
            value: $request->getPayload()->get('value'),
        );

        return new JsonResponse(['message' => 'Success']);
    }
}