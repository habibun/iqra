<?php

namespace App\Quran\Domain\Model;

use App\Quran\Domain\Model\Chapter\Info;
use App\Quran\Domain\Model\Chapter\TranslatedName;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\Collection;

class Chapter
{
    private Uuid $id;
    private string $revelationPlace;
    private int $revelationOrder;
    private bool $bismillahPre;
    private string $nameSimple;
    private string $nameComplex;
    private string $nameArabic;
    private int $versesCount;
    private array $pages;
    private Collection $translatedNames;
    private info $info;

    public static function create(
        Uuid $id,
        string $revelationPlace,
        int $revelationOrder,
        bool $bismillahPre,
        string $nameSimple,
        string $nameComplex,
        string $nameArabic,
        int $versesCount,
        array $pages,
        Info $info
    ): static {
        return new static(
            $id,
            $revelationPlace,
            $revelationOrder,
            $bismillahPre,
            $nameSimple,
            $nameComplex,
            $nameArabic,
            $versesCount,
            $pages,
            $info
        );
    }

    private function __construct(
        Uuid $id,
        string $revelationPlace,
        int $revelationOrder,
        bool $bismillahPre,
        string $nameSimple,
        string $nameComplex,
        string $nameArabic,
        int $versesCount,
        array $pages,
        $info
    ) {
        $this->id = $id;
        $this->setRevelationPlace($revelationPlace);
        $this->setRevelationOrder($revelationOrder);
        $this->setBismillahPre($bismillahPre);
        $this->setNameSimple($nameSimple);
        $this->setNameComplex($nameComplex);
        $this->setNameArabic($nameArabic);
        $this->setVersesCount($versesCount);
        $this->setPages($pages);
        $this->setInfo($info);
    }

    public function getId(): Uuid
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
            throw new \RuntimeException('Revelation Place cannot be empty');
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

    public function getNameSimple(): string
    {
        return $this->nameSimple;
    }

    public function setNameSimple(string $nameSimple): Chapter
    {
        $this->nameSimple = $nameSimple;

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

    public function getInfo(): ?Info
    {
        return $this->info ?? null;
    }

    public function setInfo(Info $info): Chapter
    {
        $this->info = $info;

        return $this;
    }
    public function addTranslatedName(string $name, Language $targetLanguage): void
    {
        $exists = $this->translatedNames->exists(function ($key, $value) use ($targetLanguage, $name) {
            return $value->getTargetLanguage() === $targetLanguage && $value->getName() === $name;
        });

        if (!$exists) {
            $this->translatedNames[] = new TranslatedName($name, $targetLanguage, $this);
        }
    }

    public function getTranslatedNames(): Collection
    {
        return $this->translatedNames;
    }
}
