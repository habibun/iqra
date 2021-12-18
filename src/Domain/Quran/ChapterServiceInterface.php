<?php

namespace App\Domain\Quran;

use App\Domain\Quran\Chapter\RevelationType;

interface ChapterServiceInterface
{
    public function create(string $number, string $name, string $englishName, string $englishNameTranslation, RevelationType $revelationType);
}
