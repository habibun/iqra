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
    private string $name;

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

    public static function getPreDefinedType()
    {
        return [
            'tafsir' => Type::TAFSIR,
            'translation' => Type::TRANSLATION,
            'quran' => Type::QURAN,
            'transliteration' => Type::TRANSLITERATION,
            'versebyverse' => Type::VERSEBYVERSE,
        ];
    }
}
