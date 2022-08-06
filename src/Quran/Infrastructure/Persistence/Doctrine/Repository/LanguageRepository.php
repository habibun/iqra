<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Repository\LanguageRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

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

    public function nextIdentity(): Uuid
    {
        return Uuid::fromString((string) SymfonyUuid::v4());
    }
}
