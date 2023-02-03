<?php

namespace App\Context\Domain\Model\Group;

use App\Context\Domain\Model\Group;
use App\Shared\Domain\Model\Language;

class Translation
{
    private readonly int $id;
    private string $name;
    private string $summary;
    private Language $language;
    private Group $group;

    public function __construct(string $name, string $summary, Language $language, Group $group)
    {
        $this->setName($name);
        $this->setSummary($summary);
        $this->setLanguage($language);
        $this->setGroup($group);
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function setGroup(Group $group): Translation
    {
        $this->group = $group;

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
