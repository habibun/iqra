<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine\Repository;

use App\Shared\Domain\Model\Language;
use App\Shared\Domain\Repository\LanguageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LanguageRepository extends ServiceEntityRepository implements LanguageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Language::class);
    }

    public function add(Language $language): void
    {
        $this->getEntityManager()->persist($language);
    }

    public function getByIsoCode(string $isoCode)
    {
        return $this->findOneBy(['isoCode' => $isoCode]);
    }

    public function getByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}
