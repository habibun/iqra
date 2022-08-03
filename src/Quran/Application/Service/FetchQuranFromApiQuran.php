<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Chapter\Info;
use App\Quran\Domain\Model\Language;
use App\Quran\Domain\Service\FetchQuranInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchQuranFromApiQuran implements FetchQuranInterface
{
    private const baseUrl = 'https://api.quran.com/api/v4';
    private HttpClientInterface $client;
    private ChapterService $chapterService;
    private LanguageService $languageService;
    private TranslationService $translationService;

    public function __construct(
        HttpClientInterface $client,
        ChapterService $chapterService,
        LanguageService $languageService,
        TranslationService $translationService,
    ) {
        $this->client = $client;
        $this->chapterService = $chapterService;
        $this->languageService = $languageService;
        $this->translationService = $translationService;
    }

    public function fetch()
    {
        echo sprintf('Fetching languages...%s', PHP_EOL);
        $this->fetchLanguage();

        echo sprintf('Fetching translation...%s', PHP_EOL);
        $this->fetchTranslation();

        echo sprintf('Fetching chapters...%s', PHP_EOL);
        $this->fetchChapter();
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

    private function fetchLanguage(): void
    {
        $predefinedLanguages = [Language::ENGLISH['iso_code'], Language::BENGALI['iso_code']];
        foreach ($predefinedLanguages as $isoCode) {
            $languages = $this->makeRequest('/resources/languages', ['language' => $isoCode]);

            foreach ($languages['languages'] as $lang) {
                if (!in_array($lang['iso_code'], $predefinedLanguages)) {
                    continue;
                }

                $language = $this->languageService->getByIsoCode($lang['iso_code']);
                if (!$language) {
                    $language = $this->languageService->createLanguage(
                        $this->languageService->getNextIdentity(),
                        $lang['name'],
                        $lang['native_name'],
                        $lang['iso_code'],
                        $lang['direction'],
                        $lang['translations_count']
                    );
                }

                $translatedName = $lang['translated_name'];
                // api.quran bug - tweaking translated name for bengali language
                $bengali = Language::BENGALI['slug'];
                if (Language::BENGALI['iso_code'] === $isoCode && $translatedName['language_name'] !== $bengali) {
                    $translatedName['language_name'] = $bengali;
                    $translatedName['name'] = 'ইংরেজি';
                }

                $targetLanguage = $this->languageService->getByName(ucfirst($translatedName['language_name']));
                if ($targetLanguage) {
                    $language->addTranslatedName(
                        $targetLanguage,
                        $translatedName['name']
                    );
                }
            }
        }
    }

    private function fetchChapter(): void
    {
        $predefinedLanguages = [Language::ENGLISH['iso_code'], Language::BENGALI['iso_code']];
        foreach ($predefinedLanguages as $isoCode) {
            $chapters = $this->makeRequest('/chapters', ['language' => $isoCode]);
            foreach ($chapters['chapters'] as $ch) {
                $existingChapter = $this->chapterService->getByNameSimple($ch['name_simple']);
                $chapter = $existingChapter;
                if (!$existingChapter) {
                    $chapterInfo = $this->makeRequest('/chapters/'.$ch['id'].'/info', ['language' => $isoCode]);
                    $chapterInfo = $chapterInfo['chapter_info'];
                    $language = $this->languageService->getByIsoCode($isoCode);
                    $info = Info::create($chapterInfo['text'], $chapterInfo['short_text'], $chapterInfo['source'], $language, $chapter);
                    $chapter = $this->chapterService->createChapter(
                        $this->chapterService->getNextIdentity(),
                        $ch['revelation_place'],
                        $ch['revelation_order'],
                        $ch['bismillah_pre'],
                        $ch['name_simple'],
                        $ch['name_complex'],
                        $ch['name_arabic'],
                        $ch['verses_count'],
                        $ch['pages'],
                        $info,
                    );
                }

                $targetLanguage = $this->languageService->getByName(ucfirst($ch['translated_name']['language_name']));
                $chapter->addTranslatedName(
                    $ch['translated_name']['name'],
                    $targetLanguage,
                );
            }
        }
    }

    private function fetchTranslation(): void
    {
        $predefinedLanguages = [
             Language::ENGLISH['slug'] => Language::ENGLISH['iso_code'],
             Language::BENGALI['slug'] => Language::BENGALI['iso_code'],
        ];
        foreach ($predefinedLanguages as $isoCode) {
            $translations = $this->makeRequest('/resources/translations', ['language' => $isoCode]);

            foreach ($translations['translations'] as $tran) {
                if (!array_key_exists($tran['language_name'], $predefinedLanguages)) {
                    continue;
                }

                $language = $this->languageService->getByName(ucfirst($tran['language_name']));
                $translation = $this->translationService->createTranslation(
                    $this->translationService->getNextIdentity(),
                    $tran['name'],
                    $tran['author_name'],
                    $tran['slug'],
                    $language
                );

                $targetLanguage = $this->languageService->getByName(ucfirst($tran['language_name']));
                $translation->addTranslatedName(
                    $targetLanguage,
                    $tran['translated_name']['name'],
                );
            }
        }
    }
}
