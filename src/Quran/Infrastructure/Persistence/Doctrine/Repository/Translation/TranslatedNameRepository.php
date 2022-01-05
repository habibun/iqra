<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository\Translation;

use App\Quran\Domain\Model\Translation\TranslatedName;
use App\Quran\Domain\Repository\Translation\TranslatedNameRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TranslatedNameRepository extends ServiceEntityRepository implements TranslatedNameRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, \App\Quran\Domain\Model\Translation\TranslatedName::class);
    }

    public function add(TranslatedName $translatedName)
    {
        $this->getEntityManager()->persist($translatedName);
        $this->getEntityManager()->flush($translatedName);
    }
}
