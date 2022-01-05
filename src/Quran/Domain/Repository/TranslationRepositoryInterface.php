<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Translation;

interface TranslationRepositoryInterface
{
    public function add(Translation $translation);

    public function getBySlug(string $slug);
}
