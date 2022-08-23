<?php

namespace App\Quran\Domain\Model;

use App\Quran\Domain\Model\Chapter\Info;
use App\Quran\Domain\Model\Chapter\Translation;
use App\Quran\Domain\Model\Chapter\Verse;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Chapter
{
    private Uuid $id;
    private int $identifier;
    private string $revelationPlace;
    private int $revelationOrder;
    private bool $bismillahPre;
    private string $nameSimple;
    private string $nameComplex;
    private string $nameArabic;
    private int $versesCount;
    private array $pages;
    private info $info;
    private Collection $translations;
    private Collection $verses;

    private function __construct(
        Uuid $id,
        int $identifier,
        string $revelationPlace,
        int $revelationOrder,
        bool $bismillahPre,
        string $nameSimple,
        string $nameComplex,
        string $nameArabic,
        int $versesCount,
        array $pages,
        Info $info
    ) {
        $this->id = $id;
        $this->setIdentifier($identifier);
        $this->setRevelationPlace($revelationPlace);
        $this->setRevelationOrder($revelationOrder);
        $this->setBismillahPre($bismillahPre);
        $this->setNameSimple($nameSimple);
        $this->setNameComplex($nameComplex);
        $this->setNameArabic($nameArabic);
        $this->setVersesCount($versesCount);
        $this->setPages($pages);
        $this->setInfo($info);

        $this->translations = new ArrayCollection();
        $this->verses = new ArrayCollection();
    }

    public static function create(
        Uuid $id,
        int $identifier,
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
            $identifier,
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

    public function setRevelationPlace(string $revelationPlace): static
    {
        if (empty($revelationPlace)) {
            throw new \RuntimeException('Revelation Place cannot be empty');
        }

        $this->revelationPlace = $revelationPlace;

        return $this;
    }

    public function setRevelationOrder(int $revelationOrder): static
    {
        $this->revelationOrder = $revelationOrder;

        return $this;
    }

    public function setBismillahPre(bool $bismillahPre): static
    {
        $this->bismillahPre = $bismillahPre;

        return $this;
    }

    public function setNameSimple(string $nameSimple): static
    {
        $this->nameSimple = $nameSimple;

        return $this;
    }

    public function setNameComplex(string $nameComplex): static
    {
        $this->nameComplex = $nameComplex;

        return $this;
    }

    public function setNameArabic(string $nameArabic): static
    {
        $this->nameArabic = $nameArabic;

        return $this;
    }

    public function setVersesCount(int $versesCount): static
    {
        $this->versesCount = $versesCount;

        return $this;
    }

    public function setPages(array $pages): static
    {
        $this->pages = $pages;

        return $this;
    }

    public function setInfo(Info $info): static
    {
        $this->info = $info;

        return $this;
    }

    public function addTranslation(string $name, Language $language): void
    {
        $this->translations[] = new Translation($name, $language, $this);
    }

    public function addVerse(
        int $verseNumber,
        int $chapterVerseNumber,
        string $verseKey,
        int $juzNumber,
        int $hizbNumber,
        int $rubElHizbNumber,
        int $rukuNumber,
        int $manzilNumber,
        ?bool $sajdaNumber,
        int $pageNumber
    ): Verse {
        $verse = Verse::create(
            $verseNumber,
            $chapterVerseNumber,
            $verseKey,
            $juzNumber,
            $hizbNumber,
            $rubElHizbNumber,
            $rukuNumber,
            $manzilNumber,
            $sajdaNumber,
            $pageNumber,
            $this
        );
        $this->verses[] = $verse;

        return $verse;
    }

    public function setIdentifier(int $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): int
    {
        return $this->identifier;
    }
}
