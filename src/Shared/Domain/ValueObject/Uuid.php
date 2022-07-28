<?php

namespace App\Shared\Domain\ValueObject;

class Uuid implements \Stringable
{
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function fromString(string $uuid): Uuid
    {
        return new self($uuid);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }
}
