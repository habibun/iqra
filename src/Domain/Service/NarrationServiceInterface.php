<?php

namespace App\Domain\Service;

interface NarrationServiceInterface
{
    public function create(string $name, string $englishName);
}
