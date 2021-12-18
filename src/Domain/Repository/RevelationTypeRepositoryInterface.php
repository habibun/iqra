<?php

namespace App\Domain\Repository;

use App\Domain\Quran\Chapter\RevelationType;

interface RevelationTypeRepositoryInterface
{
    public function get(RevelationType $type);

    public function add(RevelationType $type);

    public function getOneByName(string $name);
}
