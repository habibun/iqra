<?php

namespace App\Domain\Repository;

use App\Domain\Model\Translation;

interface TranslationRepositoryInterface
{
    public function add(Translation $translation);

    public function getBySlug(string $slug);
}
