<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Chapter;
use App\Domain\Repository\ChapterRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ChapterRepository extends ServiceEntityRepository implements ChapterRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chapter::class);
    }

    public function add(Chapter $chapter)
    {
        $this->getEntityManager()->persist($chapter);
        $this->getEntityManager()->flush($chapter);
    }
}
