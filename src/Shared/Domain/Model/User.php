<?php

namespace App\Shared\Domain\Model;

use App\Shared\Domain\Model\User\Translation;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private Uuid $id;
    private string $name;
    private string $email;
    private string $password;
    private array $roles = [];
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

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        $this->email;
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
