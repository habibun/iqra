<?php

namespace App\Shared\Domain\ValueObject;

class Uuid implements \Stringable
{
    private readonly string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function fromString(string $uuid): Uuid
    {
        return new self($uuid);
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
