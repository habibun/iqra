<?php

namespace App\Domain;

use App\Domain\Quran\Chapter;
use App\Domain\Quran\Format;
use App\Domain\Quran\Language;
use App\Domain\Quran\Recitation;
use App\Domain\Quran\Translation;
use App\Domain\Quran\Type;

class Quran
{
    private int $id;
    private Format $format;
    private Type $type;
    private Translation $translation;
    private Recitation $recitation;
    private Chapter $chapters;
    private Language $language;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getTranslation(): Translation
    {
        return $this->translation;
    }

    public function setTranslation(Translation $translation): self
    {
        $this->translation = $translation;

        return $this;
    }

    public function getRecitation(): Recitation
    {
        return $this->recitation;
    }

    public function setRecitation(Recitation $recitation): self
    {
        $this->recitation = $recitation;

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
