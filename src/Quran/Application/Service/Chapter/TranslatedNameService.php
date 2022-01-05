<?php

namespace App\Quran\Application\Service\Chapter;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Chapter\TranslatedName;
use App\Quran\Domain\Repository\Chapter\TranslatedNameRepositoryInterface;

class TranslatedNameService
{
    private \App\Quran\Domain\Repository\Chapter\TranslatedNameRepositoryInterface $translatedNameRepository;

    public function __construct(\App\Quran\Domain\Repository\Chapter\TranslatedNameRepositoryInterface $translatedNameRepository)
    {
        $this->translatedNameRepository = $translatedNameRepository;
    }

    public function createTranslatedName(string $name, string $languageName, Chapter $chapter)
    {
        $translatedName = TranslatedName::create($name, $languageName, $chapter);
        $this->translatedNameRepository->add($translatedName);

        return $translatedName;
    }
}
