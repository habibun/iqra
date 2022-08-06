<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Chapter\Verse\Word;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Verse
{
    private int $id;
    private int $verseNumber;
    private int $chapterVerseNumber;
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
        int $chapterVerseNumber,
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
        $this->chapterVerseNumber = $chapterVerseNumber;
        $this->verseKey = $verseKey;
        $this->juzNumber = $juzNumber;
        $this->hizbNumber = $hizbNumber;
        $this->rubElHizbNumber = $rubElHizbNumber;
        $this->rukuNumber = $rukuNumber;
        $this->manzilNumber = $manzilNumber;
        $this->sajdaNumber = $sajdaNumber;
        $this->pageNumber = $pageNumber;
        $this->chapter = $chapter;

        $this->words = new ArrayCollection();
    }

    public static function create(
        int $verseNumber,
        int $chapterVerseNumber,
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
            $chapterVerseNumber,
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

    public function addWord(
        int $position,
        ?string $audio_url,
        string $char_type_name,
        string $code_v1,
        int $page_number,
        int $line_number,
        string $text
    ): Word {
        $word = Word::create(
            $position,
            $audio_url,
            $char_type_name,
            $code_v1,
            $page_number,
            $line_number,
            $text,
            $this
        );

        $this->words[] = $word;

        return $word;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getVerseNumber(): int
    {
        return $this->verseNumber;
    }

    public function setVerseNumber(int $verseNumber): void
    {
        $this->verseNumber = $verseNumber;
    }

    public function getChapterVerseNumber(): int
    {
        return $this->chapterVerseNumber;
    }

    public function setChapterVerseNumber(int $chapterVerseNumber): void
    {
        $this->chapterVerseNumber = $chapterVerseNumber;
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

    public function getSajdaNumber(): ?bool
    {
        return $this->sajdaNumber;
    }

    public function setSajdaNumber(?bool $sajdaNumber): void
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

    public function getChapter(): Chapter
    {
        return $this->chapter;
    }

    public function setChapter(Chapter $chapter): void
    {
        $this->chapter = $chapter;
    }

    public function getWords(): Collection
    {
        return $this->words;
    }

    public function setWords(Collection $words): void
    {
        $this->words = $words;
    }
}
