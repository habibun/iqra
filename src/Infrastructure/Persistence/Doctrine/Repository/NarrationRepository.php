<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Quran\Narration;
use App\Domain\Repository\NarrationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class NarrationRepository extends ServiceEntityRepository implements NarrationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Narration::class);
    }

    public function add(Narration $narration)
    {
        $this->getEntityManager()->persist($narration);
        $this->getEntityManager()->flush($narration);
    }
}
