<?php

namespace App\Application\Service;

use App\Domain\Quran as QuranEntity;
use App\Domain\Quran\Chapter\VerseServiceInterface;
use App\Domain\Quran\ChapterServiceInterface;
use App\Domain\Quran\NarrationServiceInterface;
use App\Domain\Repository\FormatRepositoryInterface;
use App\Domain\Repository\LanguageRepositoryInterface;
use App\Domain\Repository\RevelationTypeRepositoryInterface;
use App\Domain\Repository\TypeRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Repository\QuranRepository;
use Doctrine\ORM\EntityManagerInterface;

class QuranService
{
    private QuranRepository $quran;
    private FormatRepositoryInterface $formatRepository;
    private NarrationServiceInterface $narrationService;
    private TypeRepositoryInterface $typeRepository;
    private ChapterServiceInterface $chapterService;
    private VerseServiceInterface $verseService;
    private RevelationTypeRepositoryInterface $revelationTypeRepository;
    private EntityManagerInterface $em;
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(
        QuranRepository $quran,
        FormatRepositoryInterface $formatRepository,
        NarrationServiceInterface $narrationService,
        TypeRepositoryInterface $typeRepository,
        ChapterServiceInterface $chapterService,
        VerseServiceInterface $verseService,
        RevelationTypeRepositoryInterface $revelationTypeRepository,
        EntityManagerInterface $em,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->quran = $quran;
        $this->formatRepository = $formatRepository;
        $this->narrationService = $narrationService;
        $this->typeRepository = $typeRepository;
        $this->chapterService = $chapterService;
        $this->verseService = $verseService;
        $this->revelationTypeRepository = $revelationTypeRepository;
        $this->em = $em;
        $this->languageRepository = $languageRepository;
    }

    public function create(array $data)
    {
        $surahs = $data['surahs'];
        $edition = $data['edition'];

        $format = $this->formatRepository->getById($edition['format']);
        $language = $this->languageRepository->getById($edition['language']);
        $type = $this->typeRepository->getById($edition['type']);
        $narration = $this->narrationService->create($edition['name'], $edition['englishName']);

        $quran = (new QuranEntity())
            ->setFormat($format)
            ->setType($type)
            ->setNarration($narration)
            ->setLanguage($language)
        ;

        foreach ($surahs as $surah) {
            $revelationType = $this->revelationTypeRepository->getById(strtolower($surah['revelationType']));
            $chapter = $this->chapterService->create(
                $surah['number'],
                $surah['name'],
                $surah['englishName'],
                $surah['englishNameTranslation'],
                $revelationType,
            );

            foreach ($surah['ayahs'] as $ayah) {
                $verse = $this->verseService->create($ayah);
                $verse->setChapter($chapter);
            }

            $chapter->setQuran($quran);
        }

        $this->em->flush();

        try {
            $this->quran->store($quran);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
