<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository\Language;

use App\Quran\Domain\Model\Language\TranslatedName;
use App\Quran\Domain\Repository\Language\TranslatedNameRepositoryInterface;
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

    public function getByNameAndLanguageName(string $name, string $languageName)
    {
        return $this->findOneBy(['name' => $name, 'languageName' => $languageName]);
    }
}
