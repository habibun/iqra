<?php

namespace App\Shared\Domain\Model;

use App\Shared\Domain\Model\User\Translation;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User
{
    private Uuid $id;
    private string $name;
    private string $email;
    private Collection $translations;

    public function __construct(Uuid $id, string $name, string $email)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setEmail($email);
        $this->translations = new ArrayCollection();
    }

    public static function create(Uuid $id, string $name, string $email): static
    {
        return new static($id, $name, $email);
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function addTranslation(Language $targetLanguage, string $name): void
    {
        $exists = $this->translations->exists(function ($key, $value) use ($targetLanguage, $name) {
            return $value->getTargetLanguage() === $targetLanguage && $value->getName() === $name;
        });

        if (!$exists) {
            $this->translations[] = new Translation($name, $targetLanguage, $this);
        }
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function setTranslations(Collection $translations): User
    {
        $this->translations = $translations;

        return $this;
    }
}
