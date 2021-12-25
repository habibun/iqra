<?php

namespace App\Domain\Repository;

use App\Domain\Model\Chapter\Verse;

interface VerseRepositoryInterface
{
    public function add(Verse $verse);
}
