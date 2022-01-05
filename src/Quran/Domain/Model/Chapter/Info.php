<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;

class Info
{
    // todo - missing chapter info for bengali language
    private int $id;
    private string $text;
    private string $shortText;
    private string $languageName;
    private string $source;
    private Chapter $chapter;
}
