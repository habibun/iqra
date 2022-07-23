<?php

namespace App\Quran\Application\Service\Language;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Model\Language\TranslatedName;
use App\Quran\Domain\Repository\Language\TranslatedNameRepositoryInterface;

class TranslatedNameService
{
    private TranslatedNameRepositoryInterface $translatedNameRepository;

    public function __construct(TranslatedNameRepositoryInterface $translatedNameRepository)
    {
        $this->translatedNameRepository = $translatedNameRepository;
    }

    public function createTranslatedName(string $name, string $languageName, Language $language): TranslatedName
    {
        $translatedName = TranslatedName::create($name, $languageName, $language);
        $this->translatedNameRepository->add($translatedName);

        return $translatedName;
    }

    public function getByNameAndLanguageName(string $name, string $languageName)
    {
        return $this->translatedNameRepository->getByNameAndLanguageName($name, $languageName);
    }
}
