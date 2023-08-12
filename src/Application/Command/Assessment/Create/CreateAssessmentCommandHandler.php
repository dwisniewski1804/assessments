<?php

namespace App\Application\Command\Assessment\Create;

use App\Domain\Core\Exception\InvalidAssessmentDataException;
use App\Infrastructure\Shared\Bus\Command\CommandHandlerInterface;

class CreateAssessmentCommandHandler implements CommandHandlerInterface
{
    private CreateAssessmentUseCase $createPostUseCase;

    /**
     * @param CreateAssessmentUseCase $createPostUseCase
     */
    public function __construct(CreateAssessmentUseCase $createPostUseCase)
    {
        $this->createPostUseCase = $createPostUseCase;
    }

    /**
     * @param CreateAssessmentCommand $command
     *
     * @return void
     * @throws InvalidAssessmentDataException
     */
    public function __invoke(CreateAssessmentCommand $command): void
    {
        $this->createPostUseCase->create($command);
    }
}