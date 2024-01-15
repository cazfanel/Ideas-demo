<?php

declare(strict_types=1);

namespace App\Repository\Idea;

use App\Controller\Idea;

final class RedisIdeaRepository implements IdeaRepository
{
    private $client;
    public function __construct()
    {
        $this->client = new Predis\Client();
    }
    public function find(int $id): ?Idea
    {
        $idea = $this->client->get($this->getKey($id));
        if (!$idea) {
            return null;
        }
        return unserialize($idea);
    }

    public function update(Idea $idea)
    {
        $this->client->set(
            $this->getKey($idea->id()),
            serialize($idea)
        );
    }
    private function getKey($id)
    {
        return 'idea:' . $id;
    }
}