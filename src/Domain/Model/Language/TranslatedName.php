<?php

namespace App\Domain\Model\Language;

use App\Domain\Model\Language;

class TranslatedName
{
    private int $id;
    private string $name;
    private string $languageName;
    private Language $language;

    public static function create(string $name, string $languageName, Language $language)
    {
        return new static($name, $languageName, $language);
    }

    public function __construct(string $name, string $languageName, Language $language)
    {
        $this->setName($name);
        $this->setLanguageName($languageName);
        $this->setLanguage($language);
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
