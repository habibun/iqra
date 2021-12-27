<?php

namespace App\Domain\Repository\Translation;

use App\Domain\Model\Translation\TranslatedName;

interface TranslatedNameRepositoryInterface
{
    public function add(TranslatedName $translatedName);
}
