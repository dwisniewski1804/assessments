<?php

namespace App\Application\Command\Assessment\Create;

use App\Domain\Core\Entity\Assessment;

class CreateAssessmentResponse
{
    public function __construct(public readonly Assessment $assessment){}
}