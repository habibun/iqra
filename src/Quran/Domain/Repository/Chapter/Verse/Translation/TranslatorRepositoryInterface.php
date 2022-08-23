<?php

namespace App\Quran\Domain\Repository\Chapter\Verse\Translation;

use App\Quran\Domain\Model\Translator;
use App\Shared\Domain\ValueObject\Uuid;

interface TranslatorRepositoryInterface
{
    public function add(Translator $translation);

    public function getBySlug(string $slug);

    public function nextIdentity(): Uuid;

    public function getAll();

    public function getByIdentifier(int $identifier);
}
