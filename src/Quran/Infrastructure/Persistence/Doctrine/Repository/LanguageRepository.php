<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Repository\LanguageRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid as UuidValueObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class LanguageRepository extends ServiceEntityRepository implements LanguageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Language::class);
    }

    /**
     * @return void
     */
    public function add(Language $language)
    {
        $this->getEntityManager()->persist($language);
    }

    /**
     * @return object|null
     */
    public function getByIsoCode(string $isoCode)
    {
        return $this->findOneBy(['isoCode' => $isoCode]);
    }

    /**
     * @return object|null
     */
    public function getByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function nextIdentity(): UuidValueObject
    {
        return UuidValueObject::fromString((string) Uuid::v4());
    }
}
