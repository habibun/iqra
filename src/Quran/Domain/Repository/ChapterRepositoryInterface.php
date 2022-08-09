<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Chapter;
use App\Shared\Domain\ValueObject\Uuid;

interface ChapterRepositoryInterface
{
    public function add(Chapter $chapter): void;

    public function getByNameSimple(string $nameSimple): null|object;

    public function nextIdentity(): Uuid;

    public function getVerseByVerseNumber(int $verseNumber);
}
