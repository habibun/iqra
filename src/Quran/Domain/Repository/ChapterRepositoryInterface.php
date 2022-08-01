<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Chapter;
use App\Shared\Domain\ValueObject\Uuid;

interface ChapterRepositoryInterface
{
    public function add(Chapter $chapter);

    public function getByNameSimple(string $nameSimple);

    public function nextIdentity(): Uuid;
}
