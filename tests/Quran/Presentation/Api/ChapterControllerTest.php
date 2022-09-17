<?php

namespace App\Tests\Quran\Presentation\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChapterControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();
        $client->jsonRequest('GET', '/en/api/quran/chapters');
        $this->assertResponseIsSuccessful();
    }

    public function testRandomVerse()
    {
        $client = static::createClient();
        $client->jsonRequest('GET', '/en/api/quran/chapters/verses/random');
        $this->assertResponseIsSuccessful();
    }

    public function testDetails()
    {
        $client = static::createClient();
        $client->jsonRequest('GET', '/en/api/quran/chapters/1');
        $this->assertResponseIsSuccessful();
    }
}
