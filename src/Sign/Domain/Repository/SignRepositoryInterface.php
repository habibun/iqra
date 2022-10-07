<?php

namespace App\Sign\Domain\Repository;

use App\Shared\Domain\ValueObject\Uuid;
use App\Sign\Domain\Model\Sign;

interface SignRepositoryInterface
{
    public function add(Sign $sign);

    public function nextIdentity(): Uuid;

    public function getTranslationByIsoCode(string $isoCode);

    public function getByIdAndLanguageIso(string $id, string $languageIso);
}
