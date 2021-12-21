<?php

namespace App\Domain\Repository;

use App\Domain\Chapter;

interface ChapterRepositoryInterface
{
    public function add(Chapter $chapter);
}
