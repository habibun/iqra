<?php

namespace App\Application\Service;

use App\Domain\Chapter;
use App\Domain\Service\FetchQuranInterface;
use App\Infrastructure\Persistence\Doctrine\Repository\ChapterRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchQuranFromApiQuranInterface implements FetchQuranInterface
{
    private const baseUrl = 'https://api.quran.com/api/v4';

    private HttpClientInterface $client;
    private ChapterService $chapterService;

    public function __construct(HttpClientInterface $client, ChapterService $chapterService)
    {
        $this->client = $client;
        $this->chapterService = $chapterService;
    }

    public function fetch()
    {
        $chapters = $this->makeRequest('/chapters', ['language' => 'en']);

        foreach ($chapters['chapters'] as $chapter) {
            dd($chapter, ...$chapter);
            $this->chapterService->createChapter(...$chapter);
        }


        return $chapters;
    }

    private function makeRequest(string $url, array $params): array
    {
        $response = $this->client->request(
            'GET',
            sprintf('%s/%s?%s', self::baseUrl, $url, http_build_query($params))
        );

        $statusCode = $response->getStatusCode();
        if (200 !== $statusCode) {
            throw new \Exception('Status code is not valid');
        }

        $contentType = $response->getHeaders()['content-type'][0];
        if ('application/json; charset=utf-8' !== $contentType) {
            throw new \Exception('Content type is not valid');
        }

        return $response->toArray(true);
    }
}
