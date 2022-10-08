<?php

namespace App\Shared\Domain\Repository;

use App\Shared\Domain\Model\Language;

interface LanguageRepositoryInterface
{
    public function add(Language $language);

    public function getByIsoCode(string $isoCode);

    public function getByName(string $name);
}
