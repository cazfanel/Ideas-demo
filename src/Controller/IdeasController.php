<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\RateIdeaUseCase;
use App\Domain\RateIdeaRequest;
use App\Repository\Idea\JsonIdeaRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class IdeasController extends AbstractController
{
    private $ideaRepository;

    public function __construct(JsonIdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    /**
     * @Route("/idea/rate/{ideaId}/{rate}", name="app_rate_idea")
     * @throws Exception
     */
    public function ideaRate(int $ideaId, int $rate): Response
    {
        $useCase = new RateIdeaUseCase($this->ideaRepository);
        $useCase->execute(new RateIdeaRequest($ideaId, $rate));

        return new Response('true');
    }
}
