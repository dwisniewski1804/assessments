<?php

namespace App\Infrastructure\Persistance\Doctrine\Core\Repository;

use App\Domain\Core\Entity\Assessment;
use App\Domain\Core\Repository\AssessmentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class DoctrineAssessmentRepository extends ServiceEntityRepository implements AssessmentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assessment::class);
    }
    public function save(Assessment $assessment): Assessment
    {
        $this->getEntityManager()->persist($assessment);
        $this->getEntityManager()->flush();

        return $assessment;
    }

    public function findOneById(Uuid $id): ?Assessment
    {
        return parent::find($id);
    }
}