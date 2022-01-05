<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Chapter;

interface ChapterRepositoryInterface
{
    public function add(Chapter $chapter);

    public function getByNameSimple(string $nameSimple);
}
