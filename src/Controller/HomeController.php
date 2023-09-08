<?php

namespace App\Controller;

use App\Action\ScoreAction;
use App\Converter\ScoreEntityConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private Security $security)
    {
    }

    #[Route('/', name: 'app_game')]
    public function game(ScoreAction $action, ScoreEntityConverter $converter): Response
    {
        $user = $this->security->getUser();
        $userScores = $user ? $converter->iterableToArray($action->getUserScores($user)) : [];

        return $this->render('game.html.twig', compact('userScores'));
    }
}