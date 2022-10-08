<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;
use App\Shared\Domain\Model\Language;

class Translation
{
    private int $id;
    private string $name;
    private Language $language;
    private Chapter $chapter;

    public function __construct(string $name, Language $language, Chapter $chapter)
    {
        $this->setName($name);
        $this->setLanguage($language);
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function setChapter(Chapter $chapter): static
    {
        $this->chapter = $chapter;

        return $this;
    }

    public function getChapter(): ?Chapter
    {
        return $this->chapter;
    }
}
