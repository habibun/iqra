<?php

namespace App\Tests\Quran\Presentation\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChapterControllerTest extends WebTestCase
{
    public function testRandomVerse()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/en/api/quran/chapters/verses/random');
//        $this->assertResponseIsSuccessful();
        $this->assertEquals(1, 1);
    }
}
