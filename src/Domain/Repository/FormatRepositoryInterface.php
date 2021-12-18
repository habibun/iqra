<?php

namespace App\Domain\Repository;

use App\Domain\Quran\Format;

interface FormatRepositoryInterface
{
    public function get(Format $format);

    public function add(Format $format);

    public function getOneByName(string $name);
}
