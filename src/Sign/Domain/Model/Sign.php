<?php

namespace App\Sign\Domain\Model;

use App\Shared\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;
use App\Sign\Domain\Model\Sign\Translation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Sign
{
    private Uuid $id;
    private ?string $image;
    private Collection $translations;

    public function __construct(Uuid $id, string $image)
    {
        $this->id = $id;
        $this->image = $image;
        $this->translations = new ArrayCollection();
    }

    public static function create(Uuid $id, string $image): static
    {
        return new static($id, $image);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): Sign
    {
        $this->image = $image;

        return $this;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(string $title, string $description, string $summary, Language $language): void
    {
        $this->translations[] = new Translation($title, $summary, $description, $language, $this);
    }
}
