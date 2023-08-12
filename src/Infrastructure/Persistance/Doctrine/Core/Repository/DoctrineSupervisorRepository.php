<?php

namespace App\Infrastructure\Persistance\Doctrine\Core\Repository;

use App\Domain\Core\Entity\Assessment;
use App\Domain\Core\Entity\Supervisor;
use App\Domain\Core\Repository\AssessmentRepositoryInterface;
use App\Domain\Core\Repository\SupervisorRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class DoctrineSupervisorRepository extends ServiceEntityRepository implements SupervisorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assessment::class);
    }
    public function save(Supervisor $supervisor): Supervisor
    {
        $this->getEntityManager()->persist($supervisor);
        $this->getEntityManager()->flush();

        return $supervisor;
    }

    public function findOneById(Uuid $id): ?Supervisor
    {
        return parent::find($id);
    }
}