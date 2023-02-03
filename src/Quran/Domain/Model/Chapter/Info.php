<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;
use App\Shared\Domain\Model\Language;

class Info
{
    private readonly int $id;
    private readonly string $text;
    private readonly string $shortText;
    private readonly string $source;
    private readonly Language $language;
    private readonly Chapter $chapter;

    public function __construct(string $text, string $shortText, string $source, Language $language, Chapter $chapter)
    {
        $this->text = $text;
        $this->shortText = $shortText;
        $this->source = $source;
        $this->language = $language;
        $this->chapter = $chapter;
    }

    public static function create(string $text, string $shortText, string $source, Language $language, Chapter $chapter): static
    {
        return new static($text, $shortText, $source, $language, $chapter);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getShortText(): string
    {
        return $this->shortText;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getChapter(): Chapter
    {
        return $this->chapter;
    }
}
