<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;

interface LanguageRepositoryInterface
{
    public function add(Language $language);

    public function getByIsoCode(string $isoCode);

    public function nextIdentity(): Uuid;
}
