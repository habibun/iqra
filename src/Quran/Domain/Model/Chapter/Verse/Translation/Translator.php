<?php

namespace App\Quran\Domain\Model\Chapter\Verse\Translation;

use App\Quran\Domain\Model\Chapter\Verse\Translation\Translator\Translation;
use App\Quran\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Translator
{
    public const DEFAULT = ['en' => ['number' => '20'], 'bn' => ['number' => '161']];

    private Uuid $id;
    private int $translatorNumber;
    private string $name;
    private string $authorName;
    private ?string $slug;
    private Language $language;
    private Collection $translations;

    public static function create(Uuid $id, int $translatorNumber, string $name, string $authorName, ?string $slug, Language $language): static
    {
        return new static($id, $translatorNumber, $name, $authorName, $slug, $language);
    }

    public function __construct(Uuid $id, int $translatorNumber, string $name, string $authorName, ?string $slug, Language $language)
    {
        $this->id = $id;
        $this->setTranslatorNumber($translatorNumber);
        $this->setName($name);
        $this->setAuthorName($authorName);
        $this->setSlug($slug);
        $this->setLanguage($language);
        $this->translations = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function setAuthorName(string $authorName): static
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function setLanguage(Language $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getTranslatorNumber(): int
    {
        return $this->translatorNumber;
    }

    public function setTranslatorNumber(int $translatorNumber): void
    {
        $this->translatorNumber = $translatorNumber;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(Language $targetLanguage, string $name): void
    {
        $exists = $this->translations->exists(function ($key, $value) use ($targetLanguage, $name) {
            return $value->getTargetLanguage() === $targetLanguage && $value->getName() === $name;
        });

        if (!$exists) {
            $this->translations[] = new Translation($this, $targetLanguage, $name);
        }
    }
}
