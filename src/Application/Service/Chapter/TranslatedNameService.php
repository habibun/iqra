<?php

namespace App\Application\Service\Chapter;

use App\Domain\Model\Chapter;
use App\Domain\Model\Chapter\TranslatedName;
use App\Domain\Repository\Chapter\TranslatedNameRepositoryInterface;

class TranslatedNameService
{
    private TranslatedNameRepositoryInterface $translatedNameRepository;

    public function __construct(TranslatedNameRepositoryInterface $translatedNameRepository)
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
