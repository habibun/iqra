<?php

namespace App\Domain\Repository;

use App\Domain\Quran\Chapter;

interface ChapterRepositoryInterface
{
    public function add(Chapter $chapter);
}
