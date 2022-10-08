<?php

namespace App\Sign\Domain\Repository;

use App\Sign\Domain\Model\Sign;

interface SignRepositoryInterface
{
    public function add(Sign $sign);

    public function getTranslationByIsoCode(string $isoCode);

    public function getByIdAndLanguageIso(string $id, string $languageIso);
}
