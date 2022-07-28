<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Translation;
use App\Shared\Domain\ValueObject\Uuid;

interface TranslationRepositoryInterface
{
    public function add(Translation $translation);

    public function getBySlug(string $slug);

    public function nextIdentity(): Uuid;
}
