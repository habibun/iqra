<?php

namespace App\Quran\Domain\Model\Chapter\Verse;

use App\Quran\Domain\Model\Chapter\Verse;
use App\Quran\Domain\Model\Translator;

class Translation
{
    private int $id;
    private string $text;
    private Verse $verse;
    private Translator $translator;

    public function __construct(string $text, Translator $translator, Verse $verse)
    {
        $this->text = $text;
        $this->verse = $verse;
        $this->translator = $translator;
    }

    public static function create(string $text, Translator $translator, Verse $verse): static
    {
        return new static($text, $translator, $verse);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Translation
    {
        $this->text = $text;

        return $this;
    }

    public function getVerse(): Verse
    {
        return $this->verse;
    }

    public function setVerse(Verse $verse): Translation
    {
        $this->verse = $verse;

        return $this;
    }

    public function getTranslator(): Translator
    {
        return $this->translator;
    }

    public function setTranslator(Translator $translator): Translation
    {
        $this->translator = $translator;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
