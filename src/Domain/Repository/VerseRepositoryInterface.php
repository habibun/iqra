<?php

namespace App\Domain\Repository;

use App\Domain\Chapter\Verse;

interface VerseRepositoryInterface
{
    public function add(Verse $verse);
}
