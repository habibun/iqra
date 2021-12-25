<?php

namespace App\Domain\Repository\Language;

use App\Domain\Model\Language\TranslatedName;

interface TranslatedNameRepositoryInterface
{
    public function add(TranslatedName $language);
}
