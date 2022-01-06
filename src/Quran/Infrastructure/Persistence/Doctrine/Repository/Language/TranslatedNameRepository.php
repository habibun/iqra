<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository\Language;

use App\Quran\Domain\Model\Language\TranslatedName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TranslatedNameRepository extends ServiceEntityRepository implements \App\Quran\Domain\Repository\Language\TranslatedNameRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TranslatedName::class);
    }

    public function add(TranslatedName $translatedName)
    {
        $this->getEntityManager()->persist($translatedName);
        $this->getEntityManager()->flush($translatedName);
    }
}
