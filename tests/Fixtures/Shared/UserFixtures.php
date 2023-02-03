<?php

namespace App\Tests\Fixtures\Shared;

use App\Shared\Application\Service\LanguageService;
use App\Shared\Application\Service\UserService;
use App\Shared\Domain\Model\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private readonly UserService $userService;
    private readonly LanguageService $languageService;

    public function __construct(UserService $userService, LanguageService $languageService)
    {
        $this->userService = $userService;
        $this->languageService = $languageService;
    }

    public function load(ObjectManager $manager): void
    {
        // Translation english
        $user = $this->userService->create('admin', 'admin@localhost.com', 'admin');
        $language = $this->languageService->getByIsoCode(Language::ENGLISH['iso_code']);
        $user->addTranslation($user->getName(), $language);

        // Translation bengali
        $user = $this->userService->create('অ্যাডমিন', 'admin@localhost.com', 'অ্যাডমিন');
        $language = $this->languageService->getByIsoCode(Language::BENGALI['iso_code']);
        $user->addTranslation($user->getName(), $language);

        $manager->persist($user);

        $manager->flush();
    }
}
