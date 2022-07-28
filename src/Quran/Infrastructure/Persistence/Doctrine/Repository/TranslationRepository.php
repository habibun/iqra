<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository;

use App\Quran\Domain\Model\Translation;
use App\Quran\Domain\Repository\TranslationRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid as UuidSymfony;

class TranslationRepository extends ServiceEntityRepository implements TranslationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Translation::class);
    }

    public function add(Translation $translation)
    {
        $this->getEntityManager()->persist($translation);
        $this->getEntityManager()->flush();
    }

    public function getBySlug(string $slug)
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    public function nextIdentity(): Uuid
    {
        return Uuid::fromString((string) UuidSymfony::v4());
    }
}
