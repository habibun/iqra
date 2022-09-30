<?php

namespace App\Context\Domain\Repository;

use App\Context\Domain\Model\Group;
use App\Shared\Domain\ValueObject\Uuid;

interface GroupRepositoryInterface
{
    public function add(Group $group);

    public function nextIdentity(): Uuid;

    public function getTranslationByIsoCode(string $isoCode);

    public function getByIdAndLanguageIso(string $id, string $languageIso);
}
