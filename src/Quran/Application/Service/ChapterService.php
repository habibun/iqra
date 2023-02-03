<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Translator;
use App\Quran\Domain\Repository\ChapterRepositoryInterface;
use App\Shared\Application\Service\BaseService;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ChapterService extends BaseService
{
    private readonly ChapterRepositoryInterface $chapterRepository;
    private readonly NormalizerInterface $normalizer;

    public function __construct(
        ChapterRepositoryInterface $chapterRepository,
        NormalizerInterface $normalizer
    ) {
        $this->chapterRepository = $chapterRepository;
        $this->normalizer = $normalizer;
    }

    public function createChapter(
        int $identifier,
        string $revelationPlace,
        int $revelationOrder,
        bool $bismillahPre,
        string $nameSimple,
        string $nameComplex,
        string $nameArabic,
        int $versesCount,
        array $pages
    ): Chapter {
        $chapter = Chapter::create(
            $this->getNextIdentity(),
            $identifier,
            $revelationPlace,
            $revelationOrder,
            $bismillahPre,
            $nameSimple,
            $nameComplex,
            $nameArabic,
            $versesCount,
            $pages
        );
        $this->chapterRepository->add($chapter);

        return $chapter;
    }

    public function getByNameSimple(string $nameSimple)
    {
        return $this->chapterRepository->getByNameSimple($nameSimple);
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
        $verseTranslation = $this->chapterRepository
            ->getVerseTranslationByVerseIdentifierAndTranslatorIdentifier(
                random_int(1, 6236),
                (int) Translator::DEFAULT[$locale]['identifier']
            );

        $chapterName = null;
        foreach ($verseTranslation->getVerse()->getChapter()->getTranslations() as $translation) {
            if ($locale === $translation->getLanguage()->getIsoCode()) {
                $chapterName = $translation->getName();
            }
        }

        return [
            'text' => $verseTranslation->getText(),
            'chapter_name' => $chapterName,
            'verse_key' => $verseTranslation->getVerseKey(),
        ];
    }

    public function getByIdentifierAndTranslatorIdentifier(int $identifier, string $locale)
    {
        $chapter = $this->chapterRepository
            ->getVerseByIdentifierAndTranslatorIdentifier($identifier, (int) Translator::DEFAULT[$locale]['identifier']);

        return $this->normalizer->normalize($chapter, 'json', ['groups' => 'chapter_details']);
    }
}
