<?php

namespace App\Application\Service;

use App\Domain\Model\Translation;
use App\Domain\Repository\TranslationRepositoryInterface;

class TranslationService
{
    private TranslationRepositoryInterface $translationRepository;

    public function __construct(TranslationRepositoryInterface $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    public function createTranslation(string $name, string $authorName, ?string $slug, string $languageName): Translation
    {
        $translation = Translation::create($name, $authorName, $slug, $languageName);
        $this->translationRepository->add($translation);

        return $translation;
    }

    public function getBySlug(string $slug)
    {
        return $this->translationRepository->getBySlug($slug);
    }
}
