<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Quran;
use App\Domain\Repository\QuranRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuranRepository extends ServiceEntityRepository implements QuranRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quran::class);
    }

    public function get(Quran $quran)
    {
        // TODO: Implement get() method.
    }

    public function store(Quran $quran)
    {
        $this->getEntityManager()->persist($quran);
        $this->getEntityManager()->flush($quran);
    }
}
