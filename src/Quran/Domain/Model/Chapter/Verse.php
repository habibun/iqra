<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;
use Doctrine\Common\Collections\Collection;

class Verse
{
    private int $id;
    private int $verseNumber;
    private string $verseKey;
    private int $juzNumber;
    private int $hizbNumber;
    private int $rubElHizbNumber;
    private int $rukuNumber;
    private int $manzilNumber;
    private ?bool $sajdaNumber;
    private int $pageNumber;
    private Chapter $chapter;
    private Collection $words;

    public function __construct(
        int $verseNumber,
        string $verseKey,
        int $juzNumber,
        int $hizbNumber,
        int $rubElHizbNumber,
        int $rukuNumber,
        int $manzilNumber,
        ?bool $sajdaNumber,
        int $pageNumber,
        Chapter $chapter
    ) {
        $this->verseNumber = $verseNumber;
        $this->verseKey = $verseKey;
        $this->juzNumber = $juzNumber;
        $this->hizbNumber = $hizbNumber;
        $this->rubElHizbNumber = $rubElHizbNumber;
        $this->rukuNumber = $rukuNumber;
        $this->manzilNumber = $manzilNumber;
        $this->sajdaNumber = $sajdaNumber;
        $this->pageNumber = $pageNumber;
        $this->chapter = $chapter;
    }

    public static function create(
        int $verseNumber,
        string $verseKey,
        int $juzNumber,
        int $hizbNumber,
        int $rubElHizbNumber,
        int $rukuNumber,
        int $manzilNumber,
        ?bool $sajdaNumber,
        int $pageNumber,
        Chapter $chapter
    ): static {
        return new static(
            $verseNumber,
            $verseKey,
            $juzNumber,
            $hizbNumber,
            $rubElHizbNumber,
            $rukuNumber,
            $manzilNumber,
            $sajdaNumber,
            $pageNumber,
            $chapter
        );
    }
}
