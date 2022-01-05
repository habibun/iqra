<?php

namespace App\Quran\Domain\Model\Translation;

use App\Quran\Domain\Model\Translation;

class TranslatedName
{
    private int $id;
    private string $name;
    private string $languageName;
    private Translation $translation;

    public static function create(string $name, string $languageName, Translation $translation)
    {
        return new static($name, $languageName, $translation);
    }

    public function __construct(string $name, string $languageName, Translation $translation)
    {
        $this->setName($name);
        $this->setLanguageName($languageName);
        $this->setTranslation($translation);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TranslatedName
    {
        $this->name = $name;

        return $this;
    }

    public function getLanguageName(): string
    {
        return $this->languageName;
    }

    public function setLanguageName(string $languageName): TranslatedName
    {
        $this->languageName = $languageName;

        return $this;
    }

    public function getTranslation(): Translation
    {
        return $this->translation;
    }

    public function setTranslation(Translation $translation): TranslatedName
    {
        $this->translation = $translation;

        return $this;
    }
}
