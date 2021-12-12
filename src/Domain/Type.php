<?php

namespace App\Domain;

class Type
{
    public const TAFSIR = 1;
    public const TRANSLATION = 2;
    public const QURAN = 3;
    public const TRANSLITERATION = 4;
    public const VERSEBYVERSE = 5;

    private int $id;
    private int $name;
}
