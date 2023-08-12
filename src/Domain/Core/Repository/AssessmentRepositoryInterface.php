<?php

namespace App\Domain\Core\Repository;

use App\Domain\Core\Entity\Assessment;

interface AssessmentRepositoryInterface
{
    public function save(): Assessment;
}