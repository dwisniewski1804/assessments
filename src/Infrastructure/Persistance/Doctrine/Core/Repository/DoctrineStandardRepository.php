<?php

namespace App\Infrastructure\Persistance\Doctrine\Core\Repository;

use App\Domain\Core\Entity\Assessment;
use App\Domain\Core\Entity\Client;
use App\Domain\Core\Entity\Standard;
use App\Domain\Core\Entity\Supervisor;
use App\Domain\Core\Repository\AssessmentRepositoryInterface;
use App\Domain\Core\Repository\ClientRepositoryInterface;
use App\Domain\Core\Repository\StandardRepositoryInterface;
use App\Domain\Core\Repository\SupervisorRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class DoctrineStandardRepository extends ServiceEntityRepository implements StandardRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assessment::class);
    }
    public function save(Standard $standard): Standard
    {
        $this->getEntityManager()->persist($standard);
        $this->getEntityManager()->flush();

        return $standard;
    }

    public function findOneById(Uuid $id): ?Standard
    {
        return parent::find($id);
    }
}