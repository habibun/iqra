<?php

namespace App\Domain\Repository;

use App\Domain\Quran\Chapter\Verse;

interface VerseRepositoryInterface
{
    public function add(Verse $verse);
}
