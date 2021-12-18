<?php

namespace App\Domain\Quran\Chapter;

use App\Domain\Quran\Chapter;

class RevelationType
{
    public const MECCAN = 1;
    public const MEDINAN = 2;

    private int $id;
    private string $name;
    private Chapter $chapter;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getChapter(): Chapter
    {
        return $this->chapter;
    }

    public function setChapter(Chapter $chapter): RevelationType
    {
        $this->chapter = $chapter;

        return $this;
    }

    public static function getPreDefinedRevelationType()
    {
        return [
            'meccan' => RevelationType::MECCAN,
            'medinan' => RevelationType::MEDINAN,
        ];
    }
}
