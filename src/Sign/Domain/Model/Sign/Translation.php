<?php

namespace App\Sign\Domain\Model\Sign;

use App\Shared\Domain\Model\Language;
use App\Sign\Domain\Model\Sign;

class Translation
{
    private int $id;
    private string $title;
    private string $summary;
    private string $description;
    private Language $language;
    private Sign $sign;

    public function __construct(string $title, string $summary, string $description, Language $language, Sign $sign)
    {
        $this->title = $title;
        $this->summary = $summary;
        $this->description = $description;
        $this->language = $language;
        $this->sign = $sign;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Translation
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Translation
    {
        $this->description = $description;

        return $this;
    }

    public function getSign(): Sign
    {
        return $this->sign;
    }

    public function setSign(Sign $sign): Translation
    {
        $this->sign = $sign;

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

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): Translation
    {
        $this->summary = $summary;

        return $this;
    }
}
