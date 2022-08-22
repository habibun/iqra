<?php

namespace App\Quran\Domain\Model\Translator;

use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Model\Translator;

class Translation
{
    private int $id;
    private string $name;
    private Language $language;
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

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function setTranslator(Translator $translator): static
    {
        $this->translator = $translator;

        return $this;
    }
}
