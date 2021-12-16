<?php

namespace App\Domain\Quran;

class Type
{
    public const TAFSIR = 1;
    public const TRANSLATION = 2;
    public const QURAN = 3;
    public const TRANSLITERATION = 4;
    public const VERSEBYVERSE = 5;

    private int $id;
    private int $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): int
    {
        return $this->name;
    }

    public function setName(int $name): self
    {
        $this->name = $name;

        return $this;
    }
}
