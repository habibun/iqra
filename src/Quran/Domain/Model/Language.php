<?php

namespace App\Quran\Domain\Model;

use App\Quran\Domain\Model\Language\TranslatedName;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Language
{
    public const ENGLISH = ['iso_code' => 'en', 'slug' => 'english', 'name' => 'English'];
    public const BENGALI = ['iso_code' => 'bn', 'slug' => 'bengali', 'name' => 'Bengali'];

    private Uuid $id;
    private string $name;
    private string $nativeName;
    private string $isoCode;
    private string $direction;
    private int $translationsCount;
    private Collection $translatedNames;

    public static function create(Uuid $id, string $name, string $nativeName, string $isoCode, string $direction, int $translationsCount): static
    {
        return new static($id, $name, $nativeName, $isoCode, $direction, $translationsCount);
    }

    public function __construct(Uuid $id, string $name, string $nativeName, string $isoCode, string $direction, int $translationsCount)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setNativeName($nativeName);
        $this->setIsoCode($isoCode);
        $this->setDirection($direction);
        $this->setTranslationsCount($translationsCount);
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

    public function setNativeName(string $nativeName): static
    {
        $this->nativeName = $nativeName;

        return $this;
    }

    public function setIsoCode(string $isoCode): static
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    public function setDirection(string $direction): static
    {
        $this->direction = $direction;

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

    public function setTranslationsCount(int $translationsCount): static
    {
        $this->translationsCount = $translationsCount;

        return $this;
    }
}
