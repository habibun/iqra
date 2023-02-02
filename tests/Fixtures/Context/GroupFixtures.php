<?php

namespace App\Tests\Fixtures\Context;

use App\Context\Application\Service\GroupService;
use App\Shared\Application\Service\LanguageService;
use App\Shared\Domain\Model\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{
    private LanguageService $languageService;
    private GroupService $groupService;

    public function __construct(LanguageService $languageService, GroupService $groupService)
    {
        $this->languageService = $languageService;
        $this->groupService = $groupService;
    }

    public function load(ObjectManager $manager): void
    {
        $group = $this->groupService->createGroup();

        // Translation english
        $name = 'Wudu';
        $summary = 'Wuḍūʾ is the Islamic procedure for cleansing parts of the body, a type of ritual purification, or ablution';
        $language = $this->languageService->getByIsoCode(Language::ENGLISH['iso_code']);
        $group->addTranslation($name, $summary, $language);

        // Translation bengali
        $name = 'অযু';
        $summary = 'অযু হল ইসলামের বিধান অনুসারে দেহের অঙ্গ-প্রতঙ্গ ধৌত করার মাধ্যমে পবিত্রতা অর্জনের একটি পন্থা।';
        $language = $this->languageService->getByIsoCode(Language::BENGALI['iso_code']);
        $group->addTranslation($name, $summary, $language);

        $manager->persist($group);

        $manager->flush();
    }
}
