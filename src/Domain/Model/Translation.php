<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\Collection;

class Translation
{
    public const LANGUAGE_NAME_ENGLISH = 'english';
    public const LANGUAGE_NAME_BENGALI = 'bengali';

    private int $id;
    private string $name;
    private string $authorName;
    private ?string $slug;
    private string $languageName;
    private Collection $translatedNames;

    public static function create(string $name, string $authorName, ?string $slug, string $languageName): static
    {
        return new static($name, $authorName, $slug, $languageName);
    }

    public function __construct(string $name, string $authorName, ?string $slug, string $languageName)
    {
        $this->setName($name);
        $this->setAuthorName($authorName);
        $this->setSlug($slug);
        $this->setLanguageName($languageName);
    }

    public function getId(): int
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

    public function getLanguageName(): string
    {
        return $this->languageName;
    }

    public function setLanguageName(string $languageName): Translation
    {
        $this->languageName = $languageName;

        return $this;
    }

    public function getTranslatedNames(): Collection
    {
        return $this->translatedNames;
    }

    public function setTranslatedNames(Collection $translatedNames): Translation
    {
        $this->translatedNames = $translatedNames;

        return $this;
    }

    public static function getPredefinedTranslations()
    {
        return [
             Translation::LANGUAGE_NAME_ENGLISH => 'en',
             Translation::LANGUAGE_NAME_BENGALI => 'bn',
        ];
    }
}
