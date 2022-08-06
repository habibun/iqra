<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Language;

class TranslatedName
{
    private int $id;
    private string $name;
    private Language $targetLanguage;
    private Chapter $chapter;

    public function __construct(string $name, Language $targetLanguage, Chapter $chapter)
    {
        $this->setName($name);
        $this->setTargetLanguage($targetLanguage);
        $this->setChapter($chapter);
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

    public function setChapter(Chapter $chapter): static
    {
        $this->chapter = $chapter;

        return $this;
    }
}
