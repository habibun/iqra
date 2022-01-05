<?php

namespace App\Quran\Application\Service\Language;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Model\Language\TranslatedName;
use App\Quran\Domain\Repository\Language\TranslatedNameRepositoryInterface;

class TranslatedNameService
{
    private \App\Quran\Domain\Repository\Language\TranslatedNameRepositoryInterface $translatedNameRepository;

    public function __construct(TranslatedNameRepositoryInterface $translatedNameRepository)
    {
        $this->translatedNameRepository = $translatedNameRepository;
    }

    public function createTranslatedName(string $name, string $languageName, Language $language)
    {
        $translatedName = TranslatedName::create($name, $languageName, $language);
        $this->translatedNameRepository->add($translatedName);

        return $translatedName;
    }
}
