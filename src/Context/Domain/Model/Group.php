<?php

namespace App\Context\Domain\Model;

use App\Context\Domain\Model\Group\Translation;
use App\Shared\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Group
{
    private readonly Uuid $id;
    private Collection $contexts;
    private Collection $translations;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
        $this->contexts = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    public static function create(Uuid $id): static
    {
        return new static($id);
    }

    public function getId(): Uuid
    {
        return $this->id;
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

    public function addTranslation(string $name, string $summary, Language $language): void
    {
        $this->translations[] = new Translation($name, $summary, $language, $this);
    }
}
