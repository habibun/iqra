<?php

namespace App\Quran\Domain\Model\Chapter\Verse\Translation\Translator;

use App\Quran\Domain\Model\Chapter\Verse\Translation\Translator;
use App\Quran\Domain\Model\Language;

class Translation
{
    private int $id;
    private string $name;
    private Language $targetLanguage;
    private Translator $translator;

    public function __construct(Translator $translator, Language $language, string $name)
    {
        $this->setTranslator($translator);
        $this->setlanguage($language);
        $this->setName($name);
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

    public function getTargetLanguage(): Language
    {
        return $this->targetLanguage;
    }

    public function setLanguage(Language $targetLanguage): static
    {
        $this->targetLanguage = $targetLanguage;

        return $this;
    }

    public function setTranslator(Translator $translator): static
    {
        $this->translator = $translator;

        return $this;
    }
}
