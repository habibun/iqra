<?php

namespace App\Domain\Chapter;

class RevelationType
{
    public const MECCAN = 1;
    public const MEDINAN = 2;

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

    public static function getPreDefinedRevelationType()
    {
        return [
            'meccan' => RevelationType::MECCAN,
            'medinan' => RevelationType::MEDINAN,
        ];
    }
}
