<?php

namespace App\Quran\Domain\Model\Language;

use App\Quran\Domain\Model\Language;

class Translation
{
    private int $id;
    private Language $language;
    private Language $targetLanguage;
    private string $name;

    public function __construct(Language $language, Language $targetLanguage, string $name)
    {
        $this->setLanguage($language);
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

    public function setTargetLanguage(Language $languageName): static
    {
        $this->targetLanguage = $languageName;

        return $this;
    }

    public function setLanguage(Language $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Translation
    {
        $this->id = $id;

        return $this;
    }
}
