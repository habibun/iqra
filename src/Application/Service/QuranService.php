<?php

namespace App\Application\Service;

use App\Domain\Quran as QuranEntity;
use App\Domain\Quran\Chapter\RevelationTypeServiceInterface;
use App\Domain\Quran\Chapter\VerseServiceInterface;
use App\Domain\Quran\ChapterServiceInterface;
use App\Domain\Quran\FormatServiceInterface;
use App\Domain\Quran\NarrationServiceInterface;
use App\Domain\Quran\TypeServiceInterface;
use App\Infrastructure\Persistence\Doctrine\Repository\QuranRepository;
use Doctrine\ORM\EntityManagerInterface;

class QuranService
{
    private QuranRepository $quran;
    private FormatServiceInterface $formatService;
    private NarrationServiceInterface $narrationService;
    private TypeServiceInterface $typeService;
    private ChapterServiceInterface $chapterService;
    private VerseServiceInterface $verseService;
    private EntityManagerInterface $em;
    private RevelationTypeServiceInterface $revelationTypeService;

    public function __construct(
        QuranRepository $quran,
        FormatServiceInterface $formatService,
        NarrationServiceInterface $narrationService,
        TypeServiceInterface $typeService,
        ChapterServiceInterface $chapterService,
        VerseServiceInterface $verseService,
        RevelationTypeServiceInterface $revelationTypeService,
        EntityManagerInterface $em
    ) {
        $this->quran = $quran;
        $this->formatService = $formatService;
        $this->narrationService = $narrationService;
        $this->typeService = $typeService;
        $this->chapterService = $chapterService;
        $this->verseService = $verseService;
        $this->em = $em;
        $this->revelationTypeService = $revelationTypeService;
    }

    public function create(array $data)
    {
        $surahs = $data['surahs'];
        $edition = $data['edition'];

        $format = $this->formatService->create($edition['format']);
        $type = $this->typeService->create($edition['type']);
        $narration = $this->narrationService->create($edition['name'], $edition['englishName']);

        $quran = (new QuranEntity())
            ->setFormat($format)
            ->setType($type)
            ->setNarration($narration)
        ;

        foreach ($surahs as $surah) {
            $revelationType = $this->revelationTypeService->create(strtolower($surah['revelationType']));
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
