<?php

namespace App\Context\Domain\Model;

use App\Context\Domain\Model\Group\Translation;
use App\Quran\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Group
{
    private Uuid $id;
    private string $name;
    private string $summary;
    private Collection $contexts;
    private Collection $translations;

    private function __construct(Uuid $id, string $name, string $summary)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setSummary($summary);
        $this->contexts = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    public static function create(Uuid $id, string $name, string $summary): static
    {
        return new static($id, $name, $summary);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Group
    {
        $this->name = $name;

        return $this;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): Group
    {
        $this->summary = $summary;

        return $this;
    }

    public function getContexts(): Collection
    {
        return $this->contexts;
    }

    public function addContext(Uuid $id, string $name, Group $group): void
    {
        $this->contexts[] = new Context($id, $name, $this);
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(Uuid $id, string $name, Language $language): void
    {
        $this->translations[] = new Translation($id, $name, $language, $this);
    }
}
