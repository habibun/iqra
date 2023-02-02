<?php

namespace App\Shared\Domain\Repository;

use App\Shared\Domain\Model\User;

interface UserRepositoryInterface
{
    public function add(User $user);

    public function getByEmail(string $email);

    public function getByName(string $name);
}
