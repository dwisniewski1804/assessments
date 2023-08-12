<?php

namespace App\Application\Command\Assessment\Create;

use App\Domain\Core\Entity\Assessment;
use App\Domain\Core\Entity\Client;
use App\Domain\Core\Entity\Standard;
use App\Domain\Core\Entity\Supervisor;
use App\Domain\Core\Exception\InvalidAssessmentDataException;
use App\Domain\Core\Repository\AssessmentRepositoryInterface;
use App\Domain\Core\Repository\ClientRepositoryInterface;
use App\Domain\Core\Repository\StandardRepositoryInterface;
use App\Domain\Core\Repository\SupervisorRepositoryInterface;
use App\Domain\Shared\Exception\IdGenerationAttemptsExceededException;
use App\Domain\Shared\IdGenerator;
use Assert\LazyAssertionException;
use DateTimeInterface;
use Symfony\Component\Uid\Uuid;
use function Assert\lazy;

class CreateAssessmentUseCase
{
    private AssessmentRepositoryInterface $assessmentRepository;
    private IdGenerator $idGenerator;
    private SupervisorRepositoryInterface $supervisorRepository;
    private ClientRepositoryInterface $clientRepository;
    private StandardRepositoryInterface $standardRepository;

    /**
     * @param AssessmentRepositoryInterface $assessmentRepository
     * @param IdGenerator $idGenerator
     */
    public function __construct(
        AssessmentRepositoryInterface $assessmentRepository,
        SupervisorRepositoryInterface $supervisorRepository,
        ClientRepositoryInterface $clientRepository,
        StandardRepositoryInterface $standardRepository,
        IdGenerator $idGenerator
    )
    {
        $this->clientRepository = $clientRepository;
        $this->assessmentRepository = $assessmentRepository;
        $this->supervisorRepository = $supervisorRepository;
        $this->standardRepository = $standardRepository;
        $this->idGenerator = $idGenerator;
    }

    /**
     * @param CreateAssessmentCommand $command
     *
     * @return CreateAssessmentResponse
     * @throws InvalidAssessmentDataException
     */
    public function create(CreateAssessmentCommand $command): CreateAssessmentResponse
    {
        $id = $this->generateAssessmentId();

        $supervisor = $this->supervisorRepository->findOneById(Uuid::fromString($command->supervisorId));
        $client = $this->clientRepository->findOneById(Uuid::fromString($command->clientId));
        $standard = $this->standardRepository->findOneById(Uuid::fromString($command->standardId));

        if ($supervisor || !$client || !$standard) {
            throw new InvalidAssessmentDataException;
        }
        $assessment = new Assessment($id, $supervisor, $client, $standard, $command->date);

        try {
            $this->validate($assessment);

            $this->assessmentRepository->save($assessment);

            return new CreateAssessmentResponse($assessment);
        } catch (LazyAssertionException $e) {
            throw new InvalidAssessmentDataException($e->getMessage());
        }
    }

    /**
     * @return Uuid
     */
    private function generateAssessmentId(): Uuid
    {
        $maxAttempts = 5;
        $attempts = 0;

        $id = $this->idGenerator->generate();

        while ($attempts < $maxAttempts && !is_null($this->assessmentRepository->findOneById($id))) {

            $id = $this->idGenerator->generate();

            $attempts++;
            if ($attempts >= $maxAttempts) {
                throw new IdGenerationAttemptsExceededException($maxAttempts);
            }
        }

        return $id;
    }

    /**
     * @param Assessment $assessment
     *
     * @return void
     */
    protected function validate(Assessment $assessment): void
    {
        lazy()
            ->that($assessment->getDate())->isInstanceOf(DateTimeInterface::class)
            ->that($assessment->getClient())->isInstanceOf(Client::class)
            ->that($assessment->getStandard())->isInstanceOf(Standard::class)
            ->that($assessment->getSupervisor())->isInstanceOf(Supervisor::class)
            ->verifyNow();
    }
}