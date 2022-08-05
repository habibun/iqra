<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Repository\ChapterRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

class ChapterRepository extends ServiceEntityRepository implements ChapterRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chapter::class);
    }

    public function add(Chapter $chapter)
    {
        $this->getEntityManager()->persist($chapter);
    }

    public function getByNameSimpleAndLanguage(string $nameSimple, Language $language)
    {
        return $this->findOneBy(['nameSimple' => $nameSimple, 'language' => $language]);
    }

    public function nextIdentity(): Uuid
    {
        return Uuid::fromString((string) SymfonyUuid::v4());
    }
}
