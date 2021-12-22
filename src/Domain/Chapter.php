<?php

namespace App\Domain;

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
}
