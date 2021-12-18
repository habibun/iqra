<?php

namespace App\Domain\Repository;

use App\Domain\Quran\Type;

interface TypeRepositoryInterface
{
    public function get(Type $type);

    public function add(Type $type);

    public function getOneByName(string $name);
}
