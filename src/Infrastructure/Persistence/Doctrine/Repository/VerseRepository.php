<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Chapter\Verse;
use App\Domain\Repository\VerseRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VerseRepository extends ServiceEntityRepository implements VerseRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Verse::class);
    }

    public function add(Verse $verse)
    {
        $this->getEntityManager()->persist($verse);
        $this->getEntityManager()->flush($verse);
    }
}
