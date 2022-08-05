<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Chapter\Info;
use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Repository\ChapterRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;

class ChapterService
{
    private ChapterRepositoryInterface $chapterRepository;

    public function __construct(ChapterRepositoryInterface $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    public function createChapter(
        Uuid $id,
        int $chapterNumber,
        string $revelationPlace,
        int $revelationOrder,
        bool $bismillahPre,
        string $nameSimple,
        string $nameComplex,
        string $nameArabic,
        int $versesCount,
        array $pages,
        Language $language,
        Info $info
    ) {
        $chapter = Chapter::create($id, $chapterNumber, $revelationPlace, $revelationOrder, $bismillahPre, $nameSimple, $nameComplex, $nameArabic, $versesCount, $pages, $language, $info);
        $this->chapterRepository->add($chapter);

        return $chapter;
    }

    public function getByNameSimpleAndLanguage(string $nameSimple, Language $language)
    {
        return $this->chapterRepository->getByNameSimpleAndLanguage($nameSimple, $language);
    }

    public function getNextIdentity(): Uuid
    {
        return $this->chapterRepository->nextIdentity();
    }
}
