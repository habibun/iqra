<?php

namespace App\Domain\Quran;

interface NarrationServiceInterface
{
    public function create(string $name, string $englishName);
}
