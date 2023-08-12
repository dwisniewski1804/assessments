<?php

namespace App\Domain\Core\Entity;

class Client
{
    private array $assessments;

    public function hasActiveContractWith(Supervisor $supervisor) {
        // Implement logic to check if the client has an active contract with the supervisor
        return true; // Dummy implementation
    }

    public function hasActiveAssessmentFor(Standard $standard) {
        // Implement logic to check if the client has an active assessment for a standard
        return isset($this->assessments[$standard->id]) && !$this->assessments[$standard->id]->isExpired();
    }

    public function addAssessment(Assessment $assessment) {
        $this->assessments[$assessment->getStandard()->id] = $assessment;
    }
}