<?php

declare (strict_types = 1);

namespace App\Repository\Idea;

use App\Controller\Idea;
use Exception;
use Symfony\Component\HttpKernel\KernelInterface;

final class JsonIdeaRepository implements IdeaRepository
{
    private const FILE = '/public/mi_archivo.json';

    private $kernel;
    private $path;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        // $this->path = $this->getParameter('kernel.project_dir') . self::FILE;
        $this->path = $this->kernel->getProjectDir() . self::FILE;
    }

    public function find(int $id): ?Idea
    {
        $json = file_get_contents($this->path);
        $ideas = json_decode($json, true);

        echo '<pre>' . print_r($ideas, true) . '</pre>';
        $ideaIndex = null;
        foreach ($ideas['ideas'] as $index => $idea) {
            if ($idea['id'] === $id) {
                $row = $idea;
                $ideaIndex = $index;
                break;
            }
        }

        if ($ideaIndex === null) {
            return null;
        }

        echo '<pre>Antes: ' . print_r($row, true) . '</pre>';

        return new Idea(
            $row['id'],
            $row['title'],
            $row['description'],
            $row['rating'],
            $row['votes'],
            $row['email'] ?? '',
        );
    }
    public function update(Idea $idea): void
    {
        $json = file_get_contents($this->path);
        $ideas = json_decode($json, true);
        $ideaIndex = null;
        foreach ($ideas['ideas'] as $index => $dbIdea) {
            if ($dbIdea['id'] === $idea->id()) {
                $ideaIndex = $index;
                break;
            }
        }

        if ($ideaIndex === null) {
            throw new Exception('Invalid id');
        }

        $ideas['ideas'][$ideaIndex] = $idea->asArray();
        file_put_contents($this->path, json_encode($ideas));
        echo '<pre>Después: ' . print_r($idea->asArray(), true) . '</pre>';
    }
}
