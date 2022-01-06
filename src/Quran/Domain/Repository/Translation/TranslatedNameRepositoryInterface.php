<?php

namespace App\Quran\Domain\Repository\Translation;

use App\Quran\Domain\Model\Translation\TranslatedName;

interface TranslatedNameRepositoryInterface
{
    public function add(TranslatedName $translatedName);
}
