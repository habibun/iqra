<?php

namespace App\Quran\Domain\Repository\Chapter\Verse\Translation;

use App\Quran\Domain\Model\Translator;

interface TranslatorRepositoryInterface
{
    public function add(Translator $translation);

    public function getBySlug(string $slug);

    public function getAll();

    public function getByIdentifier(int $identifier);
}
