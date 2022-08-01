<?php

namespace App\Quran\Domain\Model\Translation;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Model\Translation;

class TranslatedName
{
    private int $id;
    private string $name;
    private Language $targetLanguage;
    private Translation $translation;

    public static function create(Translation $translation, Language $targetLanguage, string $name): static
    {
        return new static($translation, $targetLanguage, $name);
    }

    public function __construct(Translation $translation, Language $targetLanguage, string $name)
    {
        $this->setTranslation($translation);
        $this->setTargetLanguage($targetLanguage);
        $this->setName($name);
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

    public function getTargetLanguage(): Language
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage(Language $targetLanguage): TranslatedName
    {
        $this->targetLanguage = $targetLanguage;

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
