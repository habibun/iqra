<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Repository\LanguageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LanguageRepository extends ServiceEntityRepository implements LanguageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Language::class);
    }

    public function add(Language $language)
    {
        $this->getEntityManager()->persist($language);
        $this->getEntityManager()->flush();
    }

    public function getByIsoCode(string $isoCode)
    {
        return $this->findOneBy(['isoCode' => $isoCode]);
    }
}
