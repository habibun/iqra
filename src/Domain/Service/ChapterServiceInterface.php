<?php

namespace App\Domain\Service;

use App\Domain\Chapter\RevelationType;

interface ChapterServiceInterface
{
    public function create(string $number, string $name, string $englishName, string $englishNameTranslation, RevelationType $revelationType);
}
