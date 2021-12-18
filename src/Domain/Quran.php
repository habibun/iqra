<?php

namespace App\Domain;

use App\Domain\Quran\Chapter;
use App\Domain\Quran\Format;
use App\Domain\Quran\Language;
use App\Domain\Quran\Narration;
use App\Domain\Quran\Type;

class Quran
{
    private int $id;
    private Format $format;
    private Type $type;
    private Narration $narration;
    private Chapter $chapters;
    private Language $language;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFormat(): Format
    {
        return $this->format;
    }

    public function setFormat(Format $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNarration(): Narration
    {
        return $this->narration;
    }

    public function setNarration(Narration $narration): Quran
    {
        $this->narration = $narration;

        return $this;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): Quran
    {
        $this->language = $language;

        return $this;
    }

    public function getChapters(): Chapter
    {
        return $this->chapters;
    }

    public function setChapters(Chapter $chapters): self
    {
        $this->chapters = $chapters;

        return $this;
    }
}
