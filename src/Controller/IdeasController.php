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
        $path = $this->getParameter('kernel.project_dir') . '/public/mi_archivo.json';
        $json = file_get_contents($path);
        $ideas = json_decode($json, true);

        echo '<pre>' . print_r($ideas, true) . '</pre>';
        $ideaIndex = null;
        foreach ($ideas['ideas'] as $index => $idea) {
            if ($idea['id'] === $ideaId) {
                $row = $idea;
                $ideaIndex = $index;
                break;
            }
        }

        if ($ideaIndex === null) {
            throw new Exception('Invalid id');
        }

        echo '<pre>Antes: ' . print_r($row, true) . '</pre>';

        $idea = new Idea(
            $row['id'],
            $row['title'],
            $row['description'],
            $row['rating'],
            $row['votes'],
            $row['email'] ?? '',
        );
        $idea->addRating($rate);
        $ideas['ideas'][$ideaIndex] = $idea->asArray();

        $json = file_put_contents($path, json_encode($ideas));
        echo '<pre>Después: ' . print_r($idea->asArray(), true) . '</pre>';

        return new Response('true');
    }
}
