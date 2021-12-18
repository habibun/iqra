<?php

namespace App\Domain\Repository;

use App\Domain\Quran\Narration;

interface NarrationRepositoryInterface
{
    public function add(Narration $narration);
}
