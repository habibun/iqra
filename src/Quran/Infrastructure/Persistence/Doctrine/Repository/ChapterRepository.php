<?php

namespace App\Quran\Infrastructure\Persistence\Doctrine\Repository;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Chapter\Translation as ChapterTranslationEntity;
use App\Quran\Domain\Model\Chapter\Verse;
use App\Quran\Domain\Model\Chapter\Verse\Translation as VerseTranslation;
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
            ->findOneBy(['identifier' => $verseNumber]);
    }

    public function getVerseByIdentifier(int $identifier)
    {
        return $this->_em->createQueryBuilder()
            ->select('v')
            ->from(Verse::class, 'v')
            ->where('v.identifier = :identifier')
            ->setParameter('identifier', $identifier)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getVerseTranslationByVerseIdentifierAndTranslatorIdentifier(int $verseIdentifier, int $translatorIdentifier)
    {
        return $this->_em->createQueryBuilder()
            ->select('vt')
            ->from(VerseTranslation::class, 'vt')
            ->join('vt.verse', 'v')
            ->join('vt.translator', 't')
            ->where('v.identifier = :v_identifier')
            ->andWhere('t.identifier = :t_identifier')
            ->setParameter('v_identifier', $verseIdentifier)
            ->setParameter('t_identifier', $translatorIdentifier)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getTranslationByIsoCode(string $isoCode)
    {
        return $this->_em->createQueryBuilder()
            ->select('ct')
            ->from(ChapterTranslationEntity::class, 'ct')
            ->join('ct.language', 'l')
            ->where('l.isoCode = :isoCode')
            ->setParameter('isoCode', $isoCode)
            ->getQuery()
            ->getResult();
    }

    public function getVerseByIdentifierAndTranslatorIdentifier(int $identifier, int $translatorIdentifier)
    {
        return $this->_em->createQueryBuilder()
            ->select('vt')
            ->from(VerseTranslation::class, 'vt')
            ->join('vt.translator', 't')
            ->join('t.language', 'l')
            ->join('vt.verse', 'v')
            ->join('v.chapter', 'c')
            ->where('c.identifier = :identifier')
            ->andWhere('t.identifier = :t_identifier')
            ->setParameter('identifier', $identifier)
            ->setParameter('t_identifier', $translatorIdentifier)
            ->getQuery()
            ->getResult()
        ;
    }
}
