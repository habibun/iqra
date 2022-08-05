<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;

interface ChapterRepositoryInterface
{
    public function add(Chapter $chapter);

    public function getByNameSimpleAndLanguage(string $nameSimple, Language $language);

    public function nextIdentity(): Uuid;
}
