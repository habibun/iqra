<?php

namespace App\Quran\Domain\Model\Language;

final class Id
{
    private $id;

    private function __construct(string $id)
    {
        // todo - add exception if not valid
        $this->id = $id;
    }

    public static function fromString(string $id): Id
    {
        return new self($id);
    }
}
