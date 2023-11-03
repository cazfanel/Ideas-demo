<?php

declare(strict_types=1);

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class IdeasController extends AbstractController
{
    /**
     * @Route("/idea/rate/{ideaId}/{rate}", name="app_rate_idea")
     * @throws Exception
     */
    public function ideaRate(int $idea, int $rate): void
    {
        echo '<pre>'. print_r('Idea :  '.$idea, true) . '</pre>';
        echo '<pre>'. print_r('Rate : '.$rate, true) . '</pre>';
    }
}