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

        $path = $this->getParameter('kernel.project_dir') . '/public/mi_archivo.json';
        $json = file_get_contents($path);
        $data = json_decode($json, true);

        echo '<pre>'. print_r($data, true) . '</pre>';
        //busca la idea en el json (repositorio)
        foreach ($data['ideas'] as $idea) {
            if ($idea['id'] === $ideaId) {
                $row = $idea;
            }
        }
        
        //si no existe la idea, tira exception
        echo '<pre>'. print_r($row, true) . '</pre>';

        // Building the idea from the database
        $idea = new Idea();
        $idea->setId($row['id']);
        $idea->setTitle($row['title']);
        $idea->setDescription($row['description']);
        $idea->setRating($row['rating']);
        $idea->setVotes($row['votes']);
        $idea->setAuthor($row['email']);
        // Add user rating
        $idea->addRating($rating);
        // Update the idea and save it to the database
        $data = [
            'votes' => $idea->getVotes(),
            'rating' => $idea->getRating()
        ];
        $where['idea_id = ?'] = $ideaId;
        $db->update('ideas', $data, $where);
        // Redirect to view idea page
        $this->redirect('/idea/' . $ideaId);

        return new Response('');
    }
}