<?php

namespace App\Shared\Application\Dto;

use App\Shared\Domain\Model\User;

class SignUpUserResponse
{
    private string $name;
    private string $email;

    public function __construct(User $user)
    {
        $this->name = $user->getName();
        $this->email = $user->getEmail();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

}

