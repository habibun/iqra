<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Chapter\Verse;
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

    public function add(Chapter $chapter): void
    {
        $this->getEntityManager()->persist($chapter);
    }

    public function getByNameSimple(string $nameSimple): null|object
    {
        return $this->findOneBy(['nameSimple' => $nameSimple]);
    }

    public function nextIdentity(): Uuid
    {
        return Uuid::fromString((string) SymfonyUuid::v4());
    }

    public function getVerseByVerseNumber(int $verseNumber)
    {
        return $this->_em->getRepository(Verse::class)
            ->findOneBy(['verseNumber' => $verseNumber]);
    }
}
