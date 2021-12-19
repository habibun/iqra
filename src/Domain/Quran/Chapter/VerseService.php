<?php

namespace App\Domain\Quran\Chapter;

use App\Domain\Repository\VerseRepositoryInterface;

class VerseService implements VerseServiceInterface
{
    private VerseRepositoryInterface $VerseRepository;

    public function __construct(VerseRepositoryInterface $VerseRepository)
    {
        $this->VerseRepository = $VerseRepository;
    }

    public function create(array $verseData)
    {
        dump("----------\n", $verseData['sajda'], "-----------------------\n");
        $Verse = (new Verse())
            ->setNumber($verseData['number'])
            ->setText($verseData['text'])
            ->setNumberInChapter($verseData['numberInSurah'])
            ->setJuz($verseData['juz'])
            ->setManzil($verseData['manzil'])
            ->setPage($verseData['page'])
            ->setRuku($verseData['ruku'])
            ->setHizbQuarter($verseData['hizbQuarter'])
            ->setSajda($verseData['sajda'])
        ;
        $this->VerseRepository->add($Verse);

        return $Verse;
    }
}
