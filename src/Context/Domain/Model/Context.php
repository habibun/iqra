<?php

namespace App\Context\Domain\Model;

use App\Context\Domain\Model\Context\Translation;
use App\Quran\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Context
{
    private Uuid $uuid;
    private string $name;
    private Context $parent;
    private Collection $children;
    private Collection $translations;

    private function __construct(Uuid $uuid, string $name, ?Context $parent)
    {
        $this->uuid = $uuid;
        $this->setName($name);
        $this->setParent($parent);

        $this->children = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    public static function create(Uuid $id, string $name, ?Context $parent): static
    {
        return new static($id, $name, $parent);
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(string $name, Language $language, Context $parent): void
    {
        $this->translations[] = new Translation($name, $language, $this);
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

    public function getParent(): Context
    {
        return $this->parent;
    }

    public function setParent(?Context $parent): Context
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function setChildren(Collection $children): Context
    {
        $this->children = $children;

        return $this;
    }
}
