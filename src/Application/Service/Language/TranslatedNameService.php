<?php

namespace App\Application\Service\Language;

use App\Domain\Model\Language;
use App\Domain\Model\Language\TranslatedName;
use App\Domain\Repository\Language\TranslatedNameRepositoryInterface;

class TranslatedNameService
{
    private TranslatedNameRepositoryInterface $translatedNameRepository;

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
