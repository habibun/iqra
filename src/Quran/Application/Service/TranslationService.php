<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Model\Translation;
use App\Quran\Domain\Repository\TranslationRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;

class TranslationService
{
    private TranslationRepositoryInterface $translationRepository;

    public function createTranslation(Uuid $id, string $name, string $authorName, ?string $slug, Language $language): Translation
    {
        $translation = Translation::create($id, $name, $authorName, $slug, $language);
        $this->translationRepository->add($translation);

        return $translation;
    }

    public function getNextIdentity(): Uuid
    {
        return $this->translationRepository->nextIdentity();
    }
}
