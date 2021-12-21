<?php

namespace App\Domain;

class Format
{
    public const TEXT = 1;
    public const AUDIO = 2;

    private int $id;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public static function getPreDefinedFormat()
    {
        return [
            'text' => Format::TEXT,
            'audio' => Format::AUDIO,
        ];
    }
}
