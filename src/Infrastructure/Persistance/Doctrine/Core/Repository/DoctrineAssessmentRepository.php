<?php

namespace App\Infrastructure\Persistance\Doctrine\Core\Repository;

use App\Domain\Core\Entity\Assessment;
use App\Domain\Core\Repository\AssessmentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineAssessmentRepository extends ServiceEntityRepository implements AssessmentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assessment::class);
    }
    public function save(): Assessment
    {
        // TODO: Implement save() method.
    }
}