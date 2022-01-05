<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Translation;
use App\Quran\Domain\Repository\TranslationRepositoryInterface;

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
