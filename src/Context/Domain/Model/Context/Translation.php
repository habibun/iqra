<?php

namespace App\Context\Domain\Model\Context;

use App\Context\Domain\Model\Context;
use App\Shared\Domain\Model\Language;

class Translation
{
    private int $uuid;
    private string $name;
    private Language $language;
    private Context $context;

    public function __construct(string $name, Language $language, Context $context)
    {
        $this->setName($name);
        $this->setLanguage($language);
        $this->setContext($context);
    }

    public function getId(): int
    {
        return $this->uuid;
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

    public function getContext(): Context
    {
        return $this->context;
    }

    public function setContext(Context $context): Translation
    {
        $this->context = $context;

        return $this;
    }
}
