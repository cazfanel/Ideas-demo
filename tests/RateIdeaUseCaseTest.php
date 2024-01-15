<?php

namespace App\Tests;

use App\Application\RateIdeaUseCase;
use App\Controller\Idea;
use App\Domain\RateIdeaRequest;
use App\Repository\Idea\IdeaRepository;
use DomainException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\throwException;

class RateIdeaUseCaseTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function whenIdeaDoesNotExistAnExceptionShouldBeThrown(): void
    {
        $this->expectException(DomainException::class);
        $ideaRepository = new EmptyIdeaRepository();
        $useCase = new RateIdeaUseCase($ideaRepository);
        $useCase->execute(
            new RateIdeaRequest(1, 5)
        );
    }

    /**
     * @test */
    public function whenRatingAnIdeaNewRatingShouldBeAdded()
    {
        $ideaRepository = new OneIdeaRepository();
        $useCase = new RateIdeaUseCase($ideaRepository);
        $response = $useCase->execute(
            new RateIdeaRequest(1, 5)
        );
        $this->assertSame('7.50', $response->getRating());
        $this->assertTrue($ideaRepository->updateCalled);
    }
}

class EmptyIdeaRepository implements IdeaRepository
{
    function find(int $id): ?Idea
    {
        throw  new DomainException('Domain exception');
    }

    public function update(Idea $idea)
    {
        // TODO: Implement update() method.
    }
}

class OneIdeaRepository implements IdeaRepository
{
    public bool $updateCalled = false;
    public function find($id): ?Idea
    {
        return new Idea(
            1,
            'Subscribe to php[architect]',
            'Just buy it!',
            5,
            [10],
            'john@example.com'
        );
    }
    public function update(Idea $idea): void
    {
        $this->updateCalled = true;
    }
}
