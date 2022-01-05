<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;

class TranslatedName
{
    private int $id;
    private string $name;
    private string $languageName;
    private Chapter $chapter;

    public static function create(string $name, string $languageName, Chapter $chapter)
    {
        return new static($name, $languageName, $chapter);
    }

    public function __construct(string $name, string $languageName, Chapter $chapter)
    {
        $this->setName($name);
        $this->setLanguageName($languageName);
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

    public function getLanguageName(): string
    {
        return $this->languageName;
    }

    public function setLanguageName(string $languageName): TranslatedName
    {
        $this->languageName = $languageName;

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
