<?php

namespace App\Shared\Domain\Repository;

use App\Shared\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;

interface LanguageRepositoryInterface
{
    public function add(Language $language);

    public function getByIsoCode(string $isoCode);

    public function getByName(string $name);

    public function nextIdentity(): Uuid;
}
