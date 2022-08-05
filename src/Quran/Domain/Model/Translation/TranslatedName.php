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

    public function __construct(Translation $translation, Language $targetLanguage, string $name)
    {
        $this->setTranslation($translation);
        $this->setTargetLanguage($targetLanguage);
        $this->setName($name);
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

    public function getTargetLanguage(): Language
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage(Language $targetLanguage): static
    {
        $this->targetLanguage = $targetLanguage;

        return $this;
    }

    public function setTranslation(Translation $translation): static
    {
        $this->translation = $translation;

        return $this;
    }
}
