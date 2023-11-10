<?php
declare(strict_types=1);

namespace App\Repository\Idea;

use App\Controller\Idea;

interface IdeaRepository
{
    /**
     * @param int $id
     * @return null|Idea
     */
    public function find($id);

    /**
     * @param Idea $idea
     */
    public function update(Idea $idea);
}
