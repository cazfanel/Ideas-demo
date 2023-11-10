<?php

declare(strict_types=1);

namespace App\Controller;

final class Idea
{
    private $id;
    private $title;
    private $description;
    private $rating;
    private $votes;
    private $email;

    public function __construct($id, $title, $description, $rating, $votes, $email)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->rating = $rating;
        $this->votes = $votes;
        $this->email = $email;
    }

    public function addRating($rating): void
    {
        $this->votes[] = $rating;
        $count = count($this->votes);
        $total = array_sum($this->votes);
        $this->rating = number_format($total / $count, 2);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function getVotes(): array
    {
        return $this->votes;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'rating' => $this->rating,
            'votes' => $this->votes,
            'email' => $this->email,
        ];
    }
}