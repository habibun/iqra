<?php

namespace App\Domain\Repository;

use App\Domain\Model\Language;

interface LanguageRepositoryInterface
{
    public function add(Language $language);
    public function getByIsoCode(string $isoCode);
}
