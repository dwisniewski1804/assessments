<?php

namespace App\Application\Command\Assessment\Create;

class CreateAssessmentCommand
{
    public function __construct(
        public readonly string $supervisorId,
        public readonly string $clientId,
        public readonly string $standardId,
        public readonly string $date,
        public readonly int $status
    ) {}

}