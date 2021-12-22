<?php

namespace App\Application\Service;

use App\Domain\Chapter;
use App\Domain\Repository\ChapterRepositoryInterface;

class ChapterService
{
    private ChapterRepositoryInterface $chapterRepository;

    public function __construct(ChapterRepositoryInterface $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    public function createChapter($revelationPlace, $revelationOrder, $bismillahPre, $nameComplex, $nameArabic, $versesCount, $pages, $translatedName)
    {
        dd($revelationOrder);
        $post = Chapter::create($revelationPlace, $revelationOrder, $bismillahPre, $nameComplex, $nameArabic, $versesCount, $pages, $translatedName);
        $this->chapterRepository->add($post);

        return $post;
    }
}
