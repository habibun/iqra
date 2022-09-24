<?php

namespace App\Context\Application\Service;

use App\Context\Domain\Model\Context;
use App\Context\Domain\Repository\ContextRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContextService
{
    private ContextRepositoryInterface $contextRepository;
    private NormalizerInterface $normalizer;

    public function __construct(
        ContextRepositoryInterface $contextRepository,
        NormalizerInterface $normalizer
    ) {
        $this->contextRepository = $contextRepository;
        $this->normalizer = $normalizer;
    }

    public function createContext(Uuid $id, int $name, Context $parent): Context 
    {
        $context = Context::create($id, $name, $parent);
        $this->contextRepository->add($context);

        return $context;
    }

    public function getByNameSimple(string $nameSimple)
    {
        return $this->contextRepository->getByNameSimple($nameSimple);
    }

    public function getNextIdentity(): Uuid
    {
        return $this->contextRepository->nextIdentity();
    }

    public function getVerseByVerseNumber(int $verseNumber)
    {
        return $this->contextRepository->getVerseByVerseNumber($verseNumber);
    }

    public function getList(string $locale)
    {
        $verse = $this->contextRepository
            ->getTranslationByIsoCode($locale);

        return $this->normalizer->normalize($verse, 'json', ['groups' => 'context_list']);
    }

    public function getRandomVerse(string $locale)
    {
        $verseTranslation = $this->contextRepository
            ->getVerseTranslationByVerseIdentifierAndTranslatorIdentifier(
                rand(1, 6236),
                (int) Translator::DEFAULT[$locale]['identifier']
            );

        $contextName = null;
        foreach ($verseTranslation->getVerse()->getContext()->getTranslations() as $translation) {
            if ($locale === $translation->getLanguage()->getIsoCode()) {
                $contextName = $translation->getName();
            }
        }

        return [
            'text' => $verseTranslation->getText(),
            'context_name' => $contextName,
            'verse_key' => $verseTranslation->getVerseKey(),
        ];
    }

    public function getByIdentifierAndTranslatorIdentifier(int $identifier, string $locale)
    {
        $context = $this->contextRepository
            ->getVerseByIdentifierAndTranslatorIdentifier($identifier, (int) Translator::DEFAULT[$locale]['identifier']);

        return $this->normalizer->normalize($context, 'json', ['groups' => 'context_details']);
    }
}
