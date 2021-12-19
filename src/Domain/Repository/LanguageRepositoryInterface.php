<?php

namespace App\Domain\Repository;

interface LanguageRepositoryInterface
{
    public function getById(int $id);

    public function getOneByName(string $name);
}
