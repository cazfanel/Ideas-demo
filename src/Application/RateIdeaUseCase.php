<?php

declare(strict_types=1);

namespace App\Application;

use App\Controller\Idea;
use App\Domain\RateIdeaRequest;
use App\Repository\Idea\IdeaRepository;
use DomainException;

final class RateIdeaUseCase
{
    private IdeaRepository $ideaRepository;
    public function __construct(IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }
    public function execute(RateIdeaRequest $request): ?Idea
    {
        $idea = $this->ideaRepository->find($request->ideaId);

        if ($idea === null) {
            throw new DomainException('Idea not found '.$request->ideaId);
        }

        $idea->addRating($request->rating);
        $this->ideaRepository->update($idea);

        return $idea;
    }
}