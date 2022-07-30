<?php

namespace App\Quran\Domain\Model\Language;

use App\Quran\Domain\Model\Language;

class TranslatedName
{
    private int $id;
    private Language $language;
    private Language $targetLanguage;
    private string $name;

    public static function create(Language $language, Language $targetLanguage, string $name): static
    {
        return new static($language, $targetLanguage, $name);
    }

    public function __construct(Language $language, Language $targetLanguage, string $name)
    {
        $this->setLanguage($language);
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

    public function setTargetLanguage(Language $languageName): TranslatedName
    {
        $this->targetLanguage = $languageName;

        return $this;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): TranslatedName
    {
        $this->language = $language;

        return $this;
    }
}
