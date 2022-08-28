<?php

namespace App\Quran\Domain\Model;

use App\Quran\Domain\Model\Language\Translation;
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
    private Collection $translations;

    public function __construct(Uuid $id, string $name, string $nativeName, string $isoCode, string $direction)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setNativeName($nativeName);
        $this->setIsoCode($isoCode);
        $this->setDirection($direction);
        $this->translations = new ArrayCollection();
    }

    public static function create(Uuid $id, string $name, string $nativeName, string $isoCode, string $direction): static
    {
        return new static($id, $name, $nativeName, $isoCode, $direction);
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

    public function addTranslation(Language $targetLanguage, string $name): void
    {
        $exists = $this->translations->exists(function ($key, $value) use ($targetLanguage, $name) {
            return $value->getTargetLanguage() === $targetLanguage && $value->getName() === $name;
        });

        if (!$exists) {
            $this->translations[] = new Translation($this, $targetLanguage, $name);
        }
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function setTranslations(Collection $translations): Language
    {
        $this->translations = $translations;

        return $this;
    }

    public function getNativeName(): string
    {
        return $this->nativeName;
    }

    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }
}
