<?php

namespace App\Context\Domain\Repository;

use App\Context\Domain\Model\Group;

interface GroupRepositoryInterface
{
    public function add(Group $group);

    public function getTranslationByIsoCode(string $isoCode);

    public function getByIdAndLanguageIso(string $id, string $languageIso);
}
