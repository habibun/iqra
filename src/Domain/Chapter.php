<?php

namespace App\Domain;

use http\Exception\RuntimeException;

class Chapter
{
    private int $id;
    private string $revelationPlace;
    private int $revelationOrder;
    private bool $bismillahPre;
    private string $nameComplex;
    private string $nameArabic;
    private int $versesCount;
    private array $pages;
    private translatedName $translatedName;

    public static function create($revelationPlace, $revelationOrder, $bismillahPre, $nameComplex, $nameArabic, $versesCount, $pages, $translatedName)
    {
        return new static($revelationPlace, $revelationOrder, $bismillahPre, $nameComplex,$nameArabic , $versesCount, $pages,$translatedName);
    }

    private function __construct($revelationPlace, $revelationOrder, $bismillahPre, $nameComplex, $nameArabic, $versesCount, $pages, $translatedName)
    {
        $this->setRevelationPlace($revelationPlace);
        $this->setRevelationOrder($revelationOrder);
        $this->setBismillahPre($bismillahPre);
        $this->setNameComplex($nameComplex);
        $this->setNameArabic($nameArabic);
        $this->setVersesCount($versesCount);
        $this->setPages($pages);
        $this->setTranslatedName($translatedName);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRevelationPlace(): string
    {
        return $this->revelationPlace;
    }

    public function setRevelationPlace(string $revelationPlace): Chapter
    {
        if (empty($revelationPlace)) {
            throw new RuntimeException('Revelation Place cannot be empty');
        }

        $this->revelationPlace = $revelationPlace;

        return $this;
    }

    public function getRevelationOrder(): int
    {
        return $this->revelationOrder;
    }

    public function setRevelationOrder(int $revelationOrder): Chapter
    {
        $this->revelationOrder = $revelationOrder;

        return $this;
    }

    public function isBismillahPre(): bool
    {
        return $this->bismillahPre;
    }

    public function setBismillahPre(bool $bismillahPre): Chapter
    {
        $this->bismillahPre = $bismillahPre;

        return $this;
    }

    public function getNameComplex(): string
    {
        return $this->nameComplex;
    }

    public function setNameComplex(string $nameComplex): Chapter
    {
        $this->nameComplex = $nameComplex;

        return $this;
    }

    public function getNameArabic(): string
    {
        return $this->nameArabic;
    }

    public function setNameArabic(string $nameArabic): Chapter
    {
        $this->nameArabic = $nameArabic;

        return $this;
    }

    public function getVersesCount(): int
    {
        return $this->versesCount;
    }

    public function setVersesCount(int $versesCount): Chapter
    {
        $this->versesCount = $versesCount;

        return $this;
    }

    public function getPages(): array
    {
        return $this->pages;
    }

    public function setPages(array $pages): Chapter
    {
        $this->pages = $pages;

        return $this;
    }

    public function getTranslatedName(): translatedName
    {
        return $this->translatedName;
    }

    public function setTranslatedName(translatedName $translatedName): Chapter
    {
        $this->translatedName = $translatedName;

        return $this;
    }
}
