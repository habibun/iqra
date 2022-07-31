<?php

namespace App\Quran\Domain\Model;

use App\Quran\Domain\Model\Translation\TranslatedName;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Translation
{
    private Uuid $id;
    private string $name;
    private string $authorName;
    private ?string $slug;
    private Language $language;
    private Collection $translatedNames;

    public static function create(Uuid $id, string $name, string $authorName, ?string $slug, Language $language): static
    {
        return new static($id, $name, $authorName, $slug, $language);
    }

    public function __construct(Uuid $id, string $name, string $authorName, ?string $slug, Language $language)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setAuthorName($authorName);
        $this->setSlug($slug);
        $this->setLanguage($language);
        $this->translatedNames = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Translation
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): Translation
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): Translation
    {
        $this->slug = $slug;

        return $this;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): Translation
    {
        $this->language = $language;

        return $this;
    }

    public function addTranslatedName(Language $targetLanguage, string $name): void
    {
        $exists = $this->translatedNames->exists(function ($key, $value) use ($targetLanguage, $name) {
            return $value->getTargetLanguage() === $targetLanguage && $value->getName() === $name;
        });

        if (!$exists) {
            $this->translatedNames[] = new TranslatedName($this, $targetLanguage, $name);
        }
    }

    public function getTranslatedNames(): Collection
    {
        return $this->translatedNames;
    }
}
