<?php

namespace App\Quran\Domain\Model;

use App\Quran\Domain\Model\Language\TranslatedName;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Language
{
    public const ISO_CODE_ENGLISH = 'en';
    public const ISO_CODE_BENGALI = 'bn';

    private Uuid $id;
    private string $name;
    private string $nativeName;
    private string $isoCode;
    private string $direction;
    private Collection $translatedNames;

    public static function create(Uuid $id, string $name, string $nativeName, string $isoCode, string $direction): static
    {
        return new static($id, $name, $nativeName, $isoCode, $direction);
    }

    public function __construct(Uuid $id, string $name, string $nativeName, string $isoCode, string $direction)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setNativeName($nativeName);
        $this->setIsoCode($isoCode);
        $this->setDirection($direction);
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

    public function setName(string $name): Language
    {
        $this->name = $name;

        return $this;
    }

    public function getNativeName(): string
    {
        return $this->nativeName;
    }

    public function setNativeName(string $nativeName): Language
    {
        $this->nativeName = $nativeName;

        return $this;
    }

    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    public function setIsoCode(string $isoCode): Language
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): Language
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

    public function getTranslatedNames(): Collection
    {
        return $this->translatedNames;
    }

    public static function getPredefinedLanguages()
    {
        return [
             Language::ISO_CODE_ENGLISH => 'English',
             Language::ISO_CODE_BENGALI => 'Bengali',
        ];
    }
}
