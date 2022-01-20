<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository\Chapter;

use App\Quran\Domain\Model\Chapter\TranslatedName;
use App\Quran\Domain\Repository\Chapter\TranslatedNameRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TranslatedNameRepository extends ServiceEntityRepository implements TranslatedNameRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TranslatedName::class);
    }

    public function add(TranslatedName $translatedName)
    {
        $this->getEntityManager()->persist($translatedName);
        $this->getEntityManager()->flush();
    }
}
