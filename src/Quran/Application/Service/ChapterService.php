<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Chapter\Info;
use App\Quran\Domain\Model\Translator;
use App\Quran\Domain\Repository\ChapterRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ChapterService
{
    private ChapterRepositoryInterface $chapterRepository;
    private NormalizerInterface $normalizer;

    public function __construct(
        ChapterRepositoryInterface $chapterRepository,
        NormalizerInterface $normalizer
    ) {
        $this->chapterRepository = $chapterRepository;
        $this->normalizer = $normalizer;
    }

    public function createChapter(
        Uuid $id,
        int $identifier,
        string $revelationPlace,
        int $revelationOrder,
        bool $bismillahPre,
        string $nameSimple,
        string $nameComplex,
        string $nameArabic,
        int $versesCount,
        array $pages,
        Info $info
    ): Chapter {
        $chapter = Chapter::create(
            $id,
            $identifier,
            $revelationPlace,
            $revelationOrder,
            $bismillahPre,
            $nameSimple,
            $nameComplex,
            $nameArabic,
            $versesCount,
            $pages,
            $info
        );
        $this->chapterRepository->add($chapter);

        return $chapter;
    }

    public function getByNameSimple(string $nameSimple)
    {
        return $this->chapterRepository->getByNameSimple($nameSimple);
    }

    public function getNextIdentity(): Uuid
    {
        return $this->chapterRepository->nextIdentity();
    }

    public function getVerseByVerseNumber(int $verseNumber)
    {
        return $this->chapterRepository->getVerseByVerseNumber($verseNumber);
    }

    public function getList(string $locale)
    {
        $verse = $this->chapterRepository
            ->getTranslationByIsoCode($locale);

        return $this->normalizer->normalize($verse, 'json', ['groups' => 'chapter_list']);
    }

    public function getRandomVerse(string $locale)
    {
        $verse = $this->chapterRepository
            ->getVerseTranslationByVerseIdentifierAndTranslatorIdentifier(
                rand(1, 6236),
                (int) Translator::DEFAULT[$locale]['identifier']
            );

        return $this->normalizer->normalize($verse, 'json', ['groups' => 'verse_details']);
    }

    public function getByIdentifierAndTranslatorIdentifier(int $identifier, string $locale)
    {
        $chapter = $this->chapterRepository
            ->getVerseByIdentifierAndTranslatorIdentifier($identifier, (int) Translator::DEFAULT[$locale]['identifier']);

        return $this->normalizer->normalize($chapter, 'json', ['groups' => 'chapter_details']);
    }
}
