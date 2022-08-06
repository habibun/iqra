<?php

namespace App\Quran\Domain\Model\Chapter\Verse\Word;

use App\Quran\Domain\Model\Chapter\Verse\Word;
use App\Quran\Domain\Model\Language;

class Translation
{
    private int $id;
    private string $text;
    private Language $language;
    private Word $word;

    public function __construct(string $text, Language $language, Word $word)
    {
        $this->text = $text;
        $this->language = $language;
        $this->word = $word;
    }

    public static function create(string $text, Language $language, Word $word): static
    {
        return new static($text, $language, $word);
    }
}
