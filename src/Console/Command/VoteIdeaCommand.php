<?php

declare(strict_types=1);

namespace App\Console\Command;

use App\Application\RateIdeaUseCase;
use App\Domain\RateIdeaRequest;
use App\Repository\Idea\JsonIdeaRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

final class VoteIdeaCommand extends Command
{
    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('idea:rate')
            ->setDescription('Rate an idea')
            ->addArgument('id', InputArgument::REQUIRED)
            ->addArgument('rating', InputArgument::REQUIRED);
    }
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): void
    {
        $ideaId = $input->getArgument('id'); $rating = $input->getArgument('rating');
        $ideaRepository = new JsonIdeaRepository($this->kernel);
        $useCase = new RateIdeaUseCase($ideaRepository);
        $response = $useCase->execute(
            new RateIdeaRequest($ideaId, $rating)
        );
        $output->writeln('Done!');
    }
}