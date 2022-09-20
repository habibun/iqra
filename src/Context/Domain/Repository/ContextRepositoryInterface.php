<?php

namespace App\Context\Domain\Repository;

use App\Quran\Domain\Model\Chapter\Verse;

interface ContextRepositoryInterface
{
    public function add(Verse $verse);
}
