<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Repository\ChapterRepositoryInterface;

class ChapterService
{
    private ChapterRepositoryInterface $chapterRepository;

    public function __construct(ChapterRepositoryInterface $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    public function createChapter(
        string $revelationPlace,
      int $revelationOrder,
       bool $bismillahPre,
      string $nameSimple,
      string $nameComplex,
      string $nameArabic,
      int $versesCount,
        array $pages
    ) {
        $post = Chapter::create($revelationPlace, $revelationOrder, $bismillahPre, $nameSimple, $nameComplex, $nameArabic, $versesCount, $pages);
        $this->chapterRepository->add($post);

        return $post;
    }

    public function getByNameSimple(string $nameSimple)
    {
        return $this->chapterRepository->getByNameSimple($nameSimple);
    }
}
