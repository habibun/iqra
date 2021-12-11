<?php

namespace App\Domain;

class Type
{
    const TAFSIR = 1;
    const TRANSLATION = 2;
    const QURAN = 3;
    const TRANSLITERATION = 4;
    const VERSEBYVERSE= 5;

    private int $id;
    private int $name;
}
