<?php

declare(strict_types=1);

namespace App\Domain;


use App\Controller\Idea;

class RateIdeaResponse
{
    public $idea;
    public function __construct(Idea $idea)
    {
        $this->idea = $idea;
    }
}