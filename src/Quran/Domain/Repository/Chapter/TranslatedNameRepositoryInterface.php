<?php

namespace App\Quran\Domain\Repository\Chapter;

use App\Quran\Domain\Model\Chapter\TranslatedName;

interface TranslatedNameRepositoryInterface
{
    public function add(TranslatedName $translatedName);
}
