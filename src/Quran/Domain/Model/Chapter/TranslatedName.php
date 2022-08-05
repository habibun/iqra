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

    public static function create(string $name, Language $targetLanguage, Chapter $chapter): static
    {
        return new static($name, $targetLanguage, $chapter);
    }

    public function __construct(string $name, Language $targetLanguage, Chapter $chapter)
    {
        $this->setName($name);
        $this->setTargetLanguage($targetLanguage);
        $this->setChapter($chapter);
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

    public function getTargetLanguage(): ?Language
    {
        return $this->targetLanguage;
    }

    public function setTargetLanguage(Language $targetLanguage): TranslatedName
    {
        $this->targetLanguage = $targetLanguage;

        return $this;
    }

    public function getChapter(): Chapter
    {
        return $this->chapter;
    }

    public function setChapter(Chapter $chapter): TranslatedName
    {
        $this->chapter = $chapter;

        return $this;
    }
}
