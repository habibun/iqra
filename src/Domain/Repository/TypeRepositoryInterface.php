<?php

namespace App\Domain\Repository;

use App\Domain\Type;

interface TypeRepositoryInterface
{
    public function getById(int $id);

    public function add(Type $type);

    public function getOneByName(string $name);
}
