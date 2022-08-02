<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Language;

class Info
{
    private int $id;
    private string $text;
    private string $shortText;
    private Language $language;
    private string $source;
    private Chapter $chapter;
}
