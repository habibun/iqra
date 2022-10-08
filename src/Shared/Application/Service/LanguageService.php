<?php

namespace App\Shared\Application\Service;

use App\Shared\Domain\Model\Language;
use App\Shared\Domain\Repository\LanguageRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;

class LanguageService
{
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function createLanguage(Uuid $id, string $name, string $nativeName, string $isoCode, string $direction): Language
    {
        $language = Language::create($id, $name, $nativeName, $isoCode, $direction);
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
