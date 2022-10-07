<?php

namespace App\Tests\Fixtures\Sign;

use App\Quran\Application\Service\LanguageService;
use App\Quran\Domain\Model\Language;
use App\Shared\Domain\ValueObject\Uuid;
use App\Sign\Application\Service\SignService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Sign extends Fixture
{
    private LanguageService $languageService;
    private SignService $signService;

    public function __construct(LanguageService $languageService, SignService $signService)
    {
        $this->languageService = $languageService;
        $this->signService = $signService;
    }

    public function load(ObjectManager $manager): void
    {
        $image = 'Image_1';
        $sign = $this->signService->createSign($image);

        // Translation english
        $uuid = \Symfony\Component\Uid\Uuid::v4();
        $uuid = new Uuid($uuid);
        $title = 'Title_1';
        $summary = 'Wuḍūʾ is the Islamic procedure for cleansing parts of the body, a type of ritual purification, or ablution';
        $description = 'Wuḍūʾ is the Islamic procedure for cleansing parts of the body, a type of ritual purification, or ablution';
        $language = $this->languageService->getByIsoCode(Language::ENGLISH['iso_code']);
        $sign->addTranslation($uuid, $title, $summary, $description, $language);

        // Translation bengali
        $uuid = \Symfony\Component\Uid\Uuid::v4();
        $uuid = new Uuid($uuid);
        $title = 'অযু';
        $summary = 'অযু হল ইসলামের বিধান অনুসারে দেহের অঙ্গ-প্রতঙ্গ ধৌত করার মাধ্যমে পবিত্রতা অর্জনের একটি পন্থা।';
        $description = 'অযু হল ইসলামের বিধান অনুসারে দেহের অঙ্গ-প্রতঙ্গ ধৌত করার মাধ্যমে পবিত্রতা অর্জনের একটি পন্থা।';
        $language = $this->languageService->getByIsoCode(Language::BENGALI['iso_code']);
        $sign->addTranslation($uuid, $title, $description, $summary, $language);

        $manager->persist($sign);

        $manager->flush();
    }
}
