<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Repository\LanguageRepositoryInterface;

class LanguageService
{
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function createLanguage(string $id, string $name, string $nativeName, string $isoCode, string $direction): Language
    {
        $language = Language::create($id, $name, $nativeName, $isoCode, $direction);
        $this->languageRepository->add($language);

        return $language;
    }

    public function getByIsoCode(string $isoCode)
    {
        return $this->languageRepository->getByIsoCode($isoCode);
    }

    public function getNextIdentity()
    {
        return $this->languageRepository->nextIdentity();
    }
}
