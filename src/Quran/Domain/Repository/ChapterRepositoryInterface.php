<?php

namespace App\Quran\Domain\Repository;

use App\Quran\Domain\Model\Chapter;

interface ChapterRepositoryInterface
{
    public function add(Chapter $chapter): void;

    public function getByNameSimple(string $nameSimple);

    public function getVerseByVerseNumber(int $verseNumber);

    public function getVerseByIdentifier(int $identifier);

    public function getTranslationByIsoCode(string $isoCode);

    public function getVerseTranslationByVerseIdentifierAndTranslatorIdentifier(int $verseIdentifier, int $translatorIdentifier);

    public function getVerseByIdentifierAndTranslatorIdentifier(int $identifier, int $translatorIdentifier);
}
