<?php

namespace App\Application\Service\Translation;

use App\Domain\Model\Translation;
use App\Domain\Model\Translation\TranslatedName;
use App\Domain\Repository\Translation\TranslatedNameRepositoryInterface;

class TranslatedNameService
{
    private TranslatedNameRepositoryInterface $translatedNameRepository;

    public function __construct(TranslatedNameRepositoryInterface $translatedNameRepository)
    {
        $this->translatedNameRepository = $translatedNameRepository;
    }

    public function createTranslatedName(string $name, string $translationName, Translation $translation)
    {
        $translatedName = TranslatedName::create($name, $translationName, $translation);
        $this->translatedNameRepository->add($translatedName);

        return $translatedName;
    }
}
