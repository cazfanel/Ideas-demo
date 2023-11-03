<?php

declare(strict_types=1);

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class IdeasController extends AbstractController
{
    /**
     * @Route("/idea/rate/{ideaId}/{rate}", name="app_rate_idea")
     * @throws Exception
     */
    public function ideaRate(int $ideaId, int $rate): Response
    {
        //caso de uso se resuelve en este metodo
        echo '<pre>'. print_r('Idea id :  '.$ideaId, true) . '</pre>';
        echo '<pre>'. print_r('Rate : '.$rate, true) . '</pre>';
        return new Response('');
    }
}