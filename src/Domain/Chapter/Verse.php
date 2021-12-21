<?php

namespace App\Domain\Chapter;

use App\Domain\Chapter;

class Verse
{
    private int $id;
    private int $number;
    private string $text;
    private int $numberInChapter;
    private int $juz;
    private int $manzil;
    private int $page;
    private int $ruku;
    private int $hizbQuarter;
    private bool $sajda;
    private Chapter $chapter;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): Verse
    {
        $this->number = $number;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Verse
    {
        $this->text = $text;

        return $this;
    }

    public function getNumberInChapter(): int
    {
        return $this->numberInChapter;
    }

    public function setNumberInChapter(int $numberInChapter): Verse
    {
        $this->numberInChapter = $numberInChapter;

        return $this;
    }

    public function getJuz(): int
    {
        return $this->juz;
    }

    public function setJuz(int $juz): Verse
    {
        $this->juz = $juz;

        return $this;
    }

    public function getManzil(): int
    {
        return $this->manzil;
    }

    public function setManzil(int $manzil): Verse
    {
        $this->manzil = $manzil;

        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): Verse
    {
        $this->page = $page;

        return $this;
    }

    public function getRuku(): int
    {
        return $this->ruku;
    }

    public function setRuku(int $ruku): Verse
    {
        $this->ruku = $ruku;

        return $this;
    }

    public function getHizbQuarter(): int
    {
        return $this->hizbQuarter;
    }

    public function setHizbQuarter(int $hizbQuarter): Verse
    {
        $this->hizbQuarter = $hizbQuarter;

        return $this;
    }

    public function getSajda(): bool
    {
        return $this->sajda;
    }

    public function setSajda(bool $sajda): Verse
    {
        $this->sajda = $sajda;

        return $this;
    }

    public function getChapter(): Chapter
    {
        return $this->chapter;
    }

    public function setChapter(Chapter $chapter): Verse
    {
        $this->chapter = $chapter;

        return $this;
    }
}
