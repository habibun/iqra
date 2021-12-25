<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Language
{
    public const ISO_CODE_ENGLISH = 'en';
    public const ISO_CODE_BENGALI = 'bn';

    private int $id;
    private string $name;
    private string $nativeName;
    private string $isoCode;
    private string $direction;
    private ArrayCollection $translatedNames;

    public static function create(string $name, string $nativeName, string $isoCode, string $direction): static
    {
        return new static($name, $nativeName, $isoCode, $direction);
    }

    public function __construct(string $name, string $nativeName, string $isoCode, string $direction)
    {
        $this->setName($name);
        $this->setNativeName($nativeName);
        $this->setIsoCode($isoCode);
        $this->setDirection($direction);
    }

    public function getId(): int
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

    public function getTranslatedNames(): ArrayCollection
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
