<?php

namespace App\Domain\Service;

use App\Domain\Chapter;
use App\Domain\Chapter\RevelationType;
use App\Domain\Repository\ChapterRepositoryInterface;

class ChapterService implements ChapterServiceInterface
{
    private ChapterRepositoryInterface $chapterRepository;

    public function __construct(ChapterRepositoryInterface $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    public function create(string $number, string $name, string $englishName, string $englishNameTranslation, RevelationType $revelationType)
    {
        $chapter = (new Chapter())
            ->setNumber($number)
            ->setName($name)
            ->setEnglishName($englishName)
            ->setEnglishNameTranslation($englishNameTranslation)
            ->setRevelationType($revelationType)
        ;
        $this->chapterRepository->add($chapter);

        return $chapter;
    }
}
