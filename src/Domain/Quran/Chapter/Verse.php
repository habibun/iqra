<?php

namespace App\Domain\Quran\Chapter;

use App\Domain\Quran\Chapter;

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
    private int $sajda;
    private Chapter $chapter;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
