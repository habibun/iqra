<?php

namespace App\Quran\Application\Service\Translation;

use App\Quran\Domain\Model\Translation;
use App\Quran\Domain\Model\Translation\TranslatedName;
use App\Quran\Domain\Repository\Translation\TranslatedNameRepositoryInterface;

class TranslatedNameService
{
    private \App\Quran\Domain\Repository\Translation\TranslatedNameRepositoryInterface $translatedNameRepository;

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
