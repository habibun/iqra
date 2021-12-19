<?php

namespace App\Domain\Repository;

use App\Domain\Quran\Format;

interface FormatRepositoryInterface
{
    public function getById(int $id);

    public function add(Format $format);

    public function getOneByName(string $name);
}
