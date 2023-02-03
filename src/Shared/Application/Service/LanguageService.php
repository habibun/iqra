<?php

namespace App\Shared\Application\Service;

use App\Shared\Domain\Model\Language;
use App\Shared\Domain\Repository\LanguageRepositoryInterface;

class LanguageService extends BaseService
{
    private readonly LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function createLanguage(string $name, string $nativeName, string $isoCode, string $direction): Language
    {
        $language = Language::create($this->getNextIdentity(), $name, $nativeName, $isoCode, $direction);
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
}
