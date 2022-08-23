<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository;

use App\Quran\Domain\Model\Translator;
use App\Quran\Domain\Repository\Chapter\Verse\Translation\TranslatorRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid as UuidSymfony;

class TranslatorRepository extends ServiceEntityRepository implements TranslatorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Translator::class);
    }

    public function add(Translator $translation)
    {
        $this->getEntityManager()->persist($translation);
    }

    public function getBySlug(string $slug)
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    public function nextIdentity(): Uuid
    {
        return Uuid::fromString((string) UuidSymfony::v4());
    }

    public function getAll()
    {
        return $this->findAll();
    }

    public function getByIdentifier(int $identifier)
    {
        return $this->findOneBy(['identifier' => $identifier]);
    }
}
