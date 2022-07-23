<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Language;

interface LanguageRepositoryInterface
{
    public function add(Language $language);

    public function getByIsoCode(string $isoCode);
}
