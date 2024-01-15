<?php

declare(strict_types=1);

namespace App\Domain;

final class RateIdeaRequest
{
    public $ideaId;
    public $rating;
    public function __construct($ideaId, $rating)
    {
        $this->ideaId = $ideaId;
        $this->rating = $rating;
    }
}
