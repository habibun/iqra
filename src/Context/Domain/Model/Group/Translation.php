<?php

namespace App\Context\Domain\Model\Group;

use App\Context\Domain\Model\Group;
use App\Quran\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;

class Translation
{
    private Uuid $id;
    private string $name;
    private Language $language;
    private Group $group;

    public function __construct(Uuid $id, string $name, Language $language, Group $group)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setLanguage($language);
        $this->setGroup($group);
    }

    public function getId(): Uuid
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
}
