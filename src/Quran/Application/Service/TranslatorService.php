<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Translator;
use App\Quran\Domain\Repository\Chapter\Verse\Translation\TranslatorRepositoryInterface;
use App\Shared\Application\Service\BaseService;
use App\Shared\Domain\Model\Language;

class TranslatorService extends BaseService
{
    private readonly TranslatorRepositoryInterface $translationRepository;

    public function __construct(TranslatorRepositoryInterface $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    public function createTranslator(int $identifier, string $name, string $authorName, ?string $slug, Language $language): Translator
    {
        $translator = Translator::create($this->getNextIdentity(), $identifier, $name, $authorName, $slug, $language);
        $this->translationRepository->add($translator);

        return $translator;
    }

    public function getAll()
    {
        return $this->translationRepository->getAll();
    }

    public function getByIdentifier(int $identifier)
    {
        return $this->translationRepository->getByIdentifier($identifier);
    }
}
