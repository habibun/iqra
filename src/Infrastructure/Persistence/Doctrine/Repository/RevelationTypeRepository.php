<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Chapter\RevelationType;
use App\Domain\Repository\RevelationTypeRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RevelationTypeRepository extends ServiceEntityRepository implements RevelationTypeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RevelationType::class);
    }

    public function getById(int $id)
    {
        return $this->find($id);
    }

    public function getOneByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function add(RevelationType $revelationType)
    {
        $this->getEntityManager()->persist($revelationType);
        $this->getEntityManager()->flush($revelationType);
    }
}
