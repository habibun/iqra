<?php

namespace App\Quran\Application\Service\Chapter\Verse\Translation;

use App\Quran\Domain\Model\Chapter\Verse\Translation\Translator;
use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Repository\Chapter\Verse\Translation\TranslatorRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;

class TranslatorService
{
    private TranslatorRepositoryInterface $translationRepository;

    public function __construct(TranslatorRepositoryInterface $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    public function createTranslator(Uuid $id, int $translatorNumber, string $name, string $authorName, ?string $slug, Language $language): Translator
    {
        $translator = Translator::create($id, $translatorNumber, $name, $authorName, $slug, $language);
        $this->translationRepository->add($translator);

        return $translator;
    }

    public function getNextIdentity(): Uuid
    {
        return $this->translationRepository->nextIdentity();
    }

    public function getAll()
    {
        return $this->translationRepository->getAll();
    }

    public function getByTranslatorNumber(int $translatorNumber)
    {
        return $this->translationRepository->getByTranslatorNumber($translatorNumber);
    }
}
