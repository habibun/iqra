<?php

namespace App\Domain\Repository;

use App\Domain\Model\Chapter;

interface ChapterRepositoryInterface
{
    public function add(Chapter $chapter);
    public function getByNameSimple(string $nameSimple);
}
