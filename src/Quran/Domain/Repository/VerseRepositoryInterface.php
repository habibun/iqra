<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Chapter\Verse;

interface VerseRepositoryInterface
{
    public function add(Verse $verse);
}
