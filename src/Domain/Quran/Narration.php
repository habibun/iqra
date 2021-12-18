<?php

namespace App\Domain\Quran;

class Narration
{
    private int $id;
    private string $name;
    private string $englishName;

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

    public function getEnglishName(): string
    {
        return $this->englishName;
    }

    public function setEnglishName(string $englishName): Narration
    {
        $this->englishName = $englishName;

        return $this;
    }
}
