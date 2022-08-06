<?php

namespace App\Quran\Domain\Model\Chapter\Verse;

use App\Quran\Domain\Model\Chapter\Verse;
use App\Quran\Domain\Model\Chapter\Verse\Word\Translation;
use App\Quran\Domain\Model\Chapter\Verse\Word\Transliteration;
use App\Quran\Domain\Model\Language;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Word
{
    private int $id;
    private int $position;
    private ?string $audioUrl;
    private string $charTypeName;
    private string $codeV1;
    private int $pageNumber;
    private int $lineNumber;
    private string $text;
    private Verse $verse;
    private Collection $translations;
    private Collection $transliterations;

    public function __construct(
        int $position,
        ?string $audioUrl,
        string $charTypeName,
        string $codeV1,
        int $pageNumber,
        int $lineNumber,
        string $text,
        Verse $verse
    ) {
        $this->position = $position;
        $this->audioUrl = $audioUrl;
        $this->charTypeName = $charTypeName;
        $this->codeV1 = $codeV1;
        $this->pageNumber = $pageNumber;
        $this->lineNumber = $lineNumber;
        $this->text = $text;
        $this->verse = $verse;
        $this->translations = new ArrayCollection();
        $this->transliterations = new ArrayCollection();
    }

    public static function create(
        int $position,
        ?string $audioUrl,
        string $charTypeName,
        string $codeV1,
        int $pageNumber,
        int $lineNumber,
        string $text,
        Verse $verse
    ): static {
        return new static(
            $position,
            $audioUrl,
            $charTypeName,
            $codeV1,
            $pageNumber,
            $lineNumber,
            $text,
            $verse
        );
    }

    public function addTranslation(string $text, Language $language): void
    {
        $this->translations[] = Translation::create($text, $language, $this);
    }

    public function addTransliteration(?string $text, Language $language): void
    {
        $this->transliterations[] = Transliteration::create($text, $language, $this);
    }
}
