<?php

namespace App\Quran\Domain\Repository\Language;

use App\Quran\Domain\Model\Language\TranslatedName;

interface TranslatedNameRepositoryInterface
{
    public function add(TranslatedName $translatedName);
    public function getByNameAndLanguageName(string $name, string $languageName);
}
