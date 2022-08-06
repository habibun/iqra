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

    public function addTranslatedName(Language $targetLanguage, string $name): void
    {
        $exists = $this->translatedNames->exists(function ($key, $value) use ($targetLanguage, $name) {
            return $value->getTargetLanguage() === $targetLanguage && $value->getName() === $name;
        });

        if (!$exists) {
            $this->translatedNames[] = new TranslatedName($this, $targetLanguage, $name);
        }
    }
}
