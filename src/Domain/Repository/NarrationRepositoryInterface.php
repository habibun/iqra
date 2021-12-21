<?php

namespace App\Domain\Repository;

use App\Domain\Narration;

interface NarrationRepositoryInterface
{
    public function add(Narration $narration);
}
