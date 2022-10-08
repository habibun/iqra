<?php

namespace App\Context\Domain\Model;

use App\Context\Domain\Model\Context\Translation;
use App\Shared\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Context
{
    private Uuid $id;
    private string $name;
    private Group $group;
    private Collection $translations;

    public function __construct(Uuid $id, string $name, Group $group)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setGroup($group);
        $this->translations = new ArrayCollection();
    }

    public static function create(Uuid $id, string $name, Group $group): static
    {
        return new static($id, $name, $group);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Context
    {
        $this->name = $name;

        return $this;
    }

    public function getParent(): Group
    {
        return $this->group;
    }

    public function setGroup(Group $group): Context
    {
        $this->group = $group;

        return $this;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(string $name, Language $language, Context $parent): void
    {
        $this->translations[] = new Translation($name, $language, $this);
    }
}
