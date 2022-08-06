<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Language;

class Info
{
    private int $id;
    private string $text;
    private string $shortText;
    private string $source;
    private Language $language;

    public function __construct(string $text, string $shortText, string $source, Language $language)
    {
        $this->text = $text;
        $this->shortText = $shortText;
        $this->source = $source;
        $this->language = $language;
    }

    public static function create(string $text, string $shortText, string $source, Language $language): static
    {
        return new static($text, $shortText, $source, $language);
    }
}
