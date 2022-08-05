<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Repository\LanguageRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;

class LanguageService
{
    private LanguageRepositoryInterface $languageRepository;

    public function createLanguage(Uuid $id, string $name, string $nativeName, string $isoCode, string $direction, int $translationsCount): Language
    {
        $language = Language::create($id, $name, $nativeName, $isoCode, $direction, $translationsCount);
        $this->languageRepository->add($language);

        return $language;
    }

    public function getByIsoCode(string $isoCode)
    {
        return $this->languageRepository->getByIsoCode($isoCode);
    }

    public function getByName(string $name)
    {
        return $this->languageRepository->getByName($name);
    }

    public function getNextIdentity(): Uuid
    {
        return $this->languageRepository->nextIdentity();
    }
}
