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
    private bool $sajdaNumber;
    private int $pageNumber;
    private Collection $words;
    private Chapter $chapter;

    public function getId(): int
    {
        return $this->id;
    }

    public function getVerseNumber(): int
    {
        return $this->verseNumber;
    }

    public function setVerseNumber(int $verseNumber): void
    {
        $this->verseNumber = $verseNumber;
    }

    public function getVerseKey(): string
    {
        return $this->verseKey;
    }

    public function setVerseKey(string $verseKey): void
    {
        $this->verseKey = $verseKey;
    }

    public function getJuzNumber(): int
    {
        return $this->juzNumber;
    }

    public function setJuzNumber(int $juzNumber): void
    {
        $this->juzNumber = $juzNumber;
    }

    public function getHizbNumber(): int
    {
        return $this->hizbNumber;
    }

    public function setHizbNumber(int $hizbNumber): void
    {
        $this->hizbNumber = $hizbNumber;
    }

    public function getRubElHizbNumber(): int
    {
        return $this->rubElHizbNumber;
    }

    public function setRubElHizbNumber(int $rubElHizbNumber): void
    {
        $this->rubElHizbNumber = $rubElHizbNumber;
    }

    public function getRukuNumber(): int
    {
        return $this->rukuNumber;
    }

    public function setRukuNumber(int $rukuNumber): void
    {
        $this->rukuNumber = $rukuNumber;
    }

    public function getManzilNumber(): int
    {
        return $this->manzilNumber;
    }

    public function setManzilNumber(int $manzilNumber): void
    {
        $this->manzilNumber = $manzilNumber;
    }

    public function isSajdaNumber(): bool
    {
        return $this->sajdaNumber;
    }

    public function setSajdaNumber(bool $sajdaNumber): void
    {
        $this->sajdaNumber = $sajdaNumber;
    }

    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void
    {
        $this->pageNumber = $pageNumber;
    }

    public function getWords(): Collection
    {
        return $this->words;
    }

    public function setWords(Collection $words): void
    {
        $this->words = $words;
    }

    public function getChapter(): Chapter
    {
        return $this->chapter;
    }

    public function setChapter(Chapter $chapter): void
    {
        $this->chapter = $chapter;
    }
}
