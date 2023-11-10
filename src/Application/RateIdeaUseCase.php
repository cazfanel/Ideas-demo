<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\RateIdeaRequest;
use App\Repository\Idea\IdeaRepository;
use Exception;

final class RateIdeaUseCase
{
    private $ideaRepository;
    public function __construct(IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }
    public function execute(RateIdeaRequest $request)
    {
        try {
            $idea = $this->ideaRepository->find($request->ideaId);
        } catch(Exception $e) {
            throw new RepositoryNotAvailableException();
        }
        if (!$idea) {
            throw new IdeaDoesNotExistException();
        }
        try {
            $idea->addRating($request->rating);
            $this->ideaRepository->update($idea);
        } catch(Exception $e) {
            throw new RepositoryNotAvailableException();
        }
        return $idea;
    }
}