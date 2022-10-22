<?php

namespace App\Shared\Domain\Model\User;

use App\Shared\Domain\Model\Language;
use App\Shared\Domain\Model\User;

class Translation
{
    private int $id;
    private string $name;
    private Language $language;
    private User $user;

    public function __construct(string $name, Language $language, User $user)
    {
        $this->setName($name);
        $this->setLanguage($language);
        $this->setUser($user);
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

    public function setLanguage(Language $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Translation
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
