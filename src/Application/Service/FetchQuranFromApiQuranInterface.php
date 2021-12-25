<?php

namespace App\Application\Service;

use App\Application\Service\Language\TranslatedNameService;
use App\Application\Service\Chapter\TranslatedNameService as ChapterTranslatedNameService;
use App\Domain\Model\Language;
use App\Domain\Service\FetchQuranInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchQuranFromApiQuranInterface implements FetchQuranInterface
{
    private const baseUrl = 'https://api.quran.com/api/v4';

    private HttpClientInterface $client;
    private ChapterService $chapterService;
    private LanguageService $languageService;
    private TranslatedNameService $translatedNameService;
    private ChapterTranslatedNameService $chapterTranslatedNameService;

    public function __construct(
        HttpClientInterface $client,
        ChapterService $chapterService,
        LanguageService $languageService,
        TranslatedNameService $translatedNameService,
        ChapterTranslatedNameService $chapterTranslatedNameService,
    ) {
        $this->client = $client;
        $this->chapterService = $chapterService;
        $this->languageService = $languageService;
        $this->translatedNameService = $translatedNameService;
        $this->c = $translatedNameService;
        $this->chapterTranslatedNameService = $chapterTranslatedNameService;
    }

    public function fetch()
    {
//        $this->fetchLanguage();
        $this->fetchChapter();

        dd('terminating fetch method');
    }

    private function makeRequest(string $url, array $params): array
    {
//        dd(sprintf('%s%s?%s', self::baseUrl, $url, http_build_query($params)));
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

    private function fetchLanguage(): void
    {
        $predefinedLanguages = Language::getPreDefinedLanguages();
        foreach (array_keys($predefinedLanguages) as $isoCode) {
            $languages = $this->makeRequest('/resources/languages', ['language' => $isoCode]);

            foreach ($languages['languages'] as $lang) {
                if (!array_key_exists($lang['iso_code'], $predefinedLanguages)) {
                    continue;
                }

                $existingLanguage = $this->languageService->getByIsoCode($lang['iso_code']);
                $language = $existingLanguage;
                if (!$existingLanguage) {
                    $language = $this->languageService->createLanguage(
                        $lang['name'],
                        $lang['native_name'],
                        $lang['iso_code'],
                        $lang['direction']
                    );
                }

                $this->translatedNameService->createTranslatedName(
                    $lang['translated_name']['name'],
                    $lang['translated_name']['language_name'],
                    $language
                );
            }
        }
    }
    private function fetchChapter(): void
    {
        $predefinedLanguages = Language::getPreDefinedLanguages();
        foreach (array_keys($predefinedLanguages) as $isoCode) {
            $chapters = $this->makeRequest('/chapters', ['language' => $isoCode]);
            foreach ($chapters['chapters'] as $ch) {
//                unset($ch['id']);
//                dd($ch);
                $existingChapter = $this->chapterService->getByNameSimple($ch['name_simple']);
//                dd($existingChapter);
                $chapter = $existingChapter;
                if (!$existingChapter) {
//                                    dd($existingChapter);

                    $chapter = $this->chapterService->createChapter(
                        $ch['revelation_place'],
                        $ch['revelation_order'],
                        $ch['bismillah_pre'],
                        $ch['name_simple'],
                        $ch['name_complex'],
                        $ch['name_arabic'],
                        $ch['verses_count'],
                        $ch['pages']
                    );
                }

                $this->chapterTranslatedNameService->createTranslatedName(
                    $ch['translated_name']['name'],
                    $ch['translated_name']['language_name'],
                    $chapter
                );
            }
        }
    }
}
