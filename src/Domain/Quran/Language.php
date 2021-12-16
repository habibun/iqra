<?php

namespace App\Domain\Quran;

class Language
{
    public const ARABIC = 1;
    public const ENGLISH = 2;
    public const BENGALI = 3;

    private int $id;
    private int $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): int
    {
        return $this->name;
    }

    public function setName(int $name): self
    {
        $this->name = $name;

        return $this;
    }
}
