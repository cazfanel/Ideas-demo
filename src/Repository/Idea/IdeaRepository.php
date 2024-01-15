<?php
declare(strict_types=1);

namespace App\Repository\Idea;

use App\Controller\Idea;

interface IdeaRepository
{
    public function find(int $id): ?Idea;

    /**
     * @param Idea $idea
     */
    public function update(Idea $idea);
}
