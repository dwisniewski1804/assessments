<?php

namespace App\Infrastructure\Persistance\Doctrine\Core\Repository;

use App\Domain\Core\Entity\Assessment;
use App\Domain\Core\Entity\Client;
use App\Domain\Core\Entity\Supervisor;
use App\Domain\Core\Repository\AssessmentRepositoryInterface;
use App\Domain\Core\Repository\ClientRepositoryInterface;
use App\Domain\Core\Repository\SupervisorRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class DoctrineClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assessment::class);
    }
    public function save(Client $client): Client
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();

        return $client;
    }

    public function findOneById(Uuid $id): ?Client
    {
        return parent::find($id);
    }
}