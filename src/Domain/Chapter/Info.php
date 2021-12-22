<?php

namespace App\Domain\Chapter;

use App\Domain\Chapter;

class Info
{
    private int $id;
    private string $text;
    private string $shortText;
    private string $languageName;
    private string $source;
    private Chapter $chapter;
}
