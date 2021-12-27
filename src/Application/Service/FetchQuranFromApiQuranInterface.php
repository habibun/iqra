<?php

namespace App\Application\Service;

use App\Application\Service\Chapter\TranslatedNameService as ChapterTranslatedNameService;
use App\Application\Service\Language\TranslatedNameService as LanguageTranslatedNameService;
use App\Application\Service\Translation\TranslatedNameService as TranslationTranslatedNameService;
use App\Domain\Model\Language;
use App\Domain\Model\Translation;
use App\Domain\Service\FetchQuranInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchQuranFromApiQuranInterface implements FetchQuranInterface
{
    private const baseUrl = 'https://api.quran.com/api/v4';

    private HttpClientInterface $client;
    private ChapterService $chapterService;
    private LanguageService $languageService;
    private TranslationService $translationService;
    private LanguageTranslatedNameService $languageTranslatedNameService;
    private ChapterTranslatedNameService $chapterTranslatedNameService;
    private TranslationTranslatedNameService $translationTranslatedNameService;

    public function __construct(
        HttpClientInterface $client,
        ChapterService $chapterService,
        LanguageService $languageService,
        TranslationService $translationService,
        LanguageTranslatedNameService $languageTranslatedNameService,
        ChapterTranslatedNameService $chapterTranslatedNameService,
        TranslationTranslatedNameService $translationTranslatedNameService,
    ) {
        $this->client = $client;
        $this->chapterService = $chapterService;
        $this->languageService = $languageService;
        $this->languageTranslatedNameService = $languageTranslatedNameService;
        $this->chapterTranslatedNameService = $chapterTranslatedNameService;
        $this->translationService = $translationService;
        $this->translationTranslatedNameService = $translationTranslatedNameService;
    }

    public function fetch()
    {
        echo sprintf('...fetching language.%s', PHP_EOL);
//        $this->fetchLanguage();

        echo sprintf('...fetching chapter.%s', PHP_EOL);
//        $this->fetchChapter();

        echo sprintf('...fetching translation.%s', PHP_EOL);
        $this->fetchTranslation();
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

                $this->languageTranslatedNameService->createTranslatedName(
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
                $existingChapter = $this->chapterService->getByNameSimple($ch['name_simple']);
                $chapter = $existingChapter;
                if (!$existingChapter) {
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

    private function fetchTranslation(): void
    {
        $predefinedTranslations = Translation::getPredefinedTranslations();
        foreach (array_keys($predefinedTranslations) as $languageName) {
            $languages = $this->makeRequest('/resources/translations', ['language' => $predefinedTranslations[$languageName]]);

            foreach ($languages['translations'] as $tran) {
                if (!array_key_exists($tran['language_name'], $predefinedTranslations)) {
                    continue;
                }

                $translation = $this->translationService->createTranslation(
                    $tran['name'],
                    $tran['author_name'],
                    $tran['slug'],
                    $tran['language_name']
                );

                $this->translationTranslatedNameService->createTranslatedName(
                    $tran['translated_name']['name'],
                    $tran['translated_name']['language_name'],
                    $translation
                );
            }
        }
    }
}
