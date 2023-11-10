<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\Idea\IdeaRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class IdeasController extends AbstractController
{
    private $ideaRepository;

    public function __construct(IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    /**
     * @Route("/idea/rate/{ideaId}/{rate}", name="app_rate_idea")
     * @throws Exception
     */
    public function ideaRate(int $ideaId, int $rate): Response
    {
        $idea = $this->ideaRepository->find($ideaId);
        $idea->addRating($rate);
        $this->ideaRepository->update($idea);

        return new Response('true');
    }
}
