<?php

namespace App\Quran\Application\Service;

use App\Quran\Domain\Model\Chapter;
use App\Quran\Domain\Model\Chapter\Info;
use App\Quran\Domain\Model\Translator;
use App\Quran\Domain\Service\FetchQuranInterface;
use App\Shared\Application\Service\LanguageService;
use App\Shared\Domain\Model\Language;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchQuranFromApiQuran implements FetchQuranInterface
{
    private const baseUrl = 'https://api.quran.com/api/v4';
    private HttpClientInterface $client;
    private ChapterService $chapterService;
    private LanguageService $languageService;
    private TranslatorService $translationService;
    private EntityManagerInterface $em;

    public function __construct(
        HttpClientInterface $client,
        ChapterService $chapterService,
        LanguageService $languageService,
        TranslatorService $translatorService,
        EntityManagerInterface $em,
    ) {
        $this->client = $client;
        $this->chapterService = $chapterService;
        $this->languageService = $languageService;
        $this->translationService = $translatorService;
        $this->em = $em;
    }

    public function fetch(): void
    {
        echo sprintf('Fetching languages...%s', PHP_EOL);
        $this->fetchLanguage();

        echo sprintf('Fetching verse translator...%s', PHP_EOL);
        $this->fetchVerseTranslator();

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

        return $response->toArray();
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
                        $lang['name'],
                        $lang['native_name'],
                        $lang['iso_code'],
                        $lang['direction']
                    );
                    $this->em->flush();
                }

                $translatedName = $lang['translated_name'];
                // api.quran bug - tweaking translated name for bengali language
                $bengali = Language::BENGALI['slug'];
                if (Language::BENGALI['iso_code'] === $isoCode && 'English' === $translatedName['name']) {
                    $translatedName['language_name'] = $bengali;
                    $translatedName['name'] = 'ইংরেজি';
                }
                if (Language::BENGALI['iso_code'] === $isoCode && 'Bengali' === $translatedName['name']) {
                    $translatedName['language_name'] = $bengali;
                    $translatedName['name'] = 'বাংলা';
                }

                $targetLanguage = $this->languageService->getByName(ucfirst($translatedName['language_name']));
                $language->addTranslation(
                    $targetLanguage,
                    $translatedName['name']
                );
            }
            $this->em->flush();
        }
        $this->em->clear();
    }

    private function fetchVerseTranslator(): void
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
                $translator = $this->translationService->getByIdentifier($tran['id']);
                if (!$translator) {
                    $translator = $this->translationService->createTranslator(
                        $tran['id'],
                        $tran['name'],
                        $tran['author_name'],
                        $tran['slug'],
                        $language
                    );
                }

                $language = $this->languageService->getByName(ucfirst($tran['language_name']));
                $translator->addTranslation(
                    $language,
                    $tran['translated_name']['name'],
                );
            }
            $this->em->flush();
        }

        $this->em->clear();
    }

    private function fetchChapter(): void
    {
        $predefinedLanguages = [Language::ENGLISH['iso_code'], Language::BENGALI['iso_code']];
        foreach ($predefinedLanguages as $isoCode) {
            $chapters = $this->makeRequest('/chapters', ['language' => $isoCode]);
            foreach ($chapters['chapters'] as $ch) {
                $language = $this->languageService->getByIsoCode($isoCode);
                $chapter = $this->chapterService->getByNameSimple($ch['name_simple']);
                if (!$chapter) {
                    echo sprintf('Fetching chapter: %d...%s', $ch['id'], PHP_EOL);
                    $chapterInfo = $this->makeRequest('/chapters/'.$ch['id'].'/info', ['language' => $isoCode]);
                    $chapterInfo = $chapterInfo['chapter_info'];
                    $chapter = $this->chapterService->createChapter(
                        $ch['id'],
                        $ch['revelation_place'],
                        $ch['revelation_order'],
                        $ch['bismillah_pre'],
                        $ch['name_simple'],
                        $ch['name_complex'],
                        $ch['name_arabic'],
                        $ch['verses_count'],
                        $ch['pages'],
                    );
                    $info = Info::create($chapterInfo['text'], $chapterInfo['short_text'], $chapterInfo['source'],
                        $language, $chapter);
                    $this->em->persist($info);
                    $this->fetchVerse($chapter);
                }

                $language = $this->languageService->getByName(ucfirst($ch['translated_name']['language_name']));
                $chapter->addTranslation(
                    $ch['translated_name']['name'],
                    $language,
                );

                $this->em->flush();
                $this->em->clear();
            }
        }
    }

    private function fetchVerse(Chapter $chapter): void
    {
        $translatorList = $this->translationService->getAll();

        $translators = [];
        /** @var Translator $translator */
        foreach ($translatorList as $translator) {
            $translators[] = $translator->getIdentifier();
        }

        $page = 1;
        $verses = $this->makeRequest(
            sprintf('/verses/by_chapter/%d', $chapter->getIdentifier()),
            [
                'words' => false,
                'page' => $page,
                'per_page' => 50,
                'translations' => implode(',', $translators),
                'translation_fields' => 'verse_key',
                'fields' => 'text_indopak',
            ]
        );

        $totalPages = $verses['pagination']['total_pages'];
        while ($totalPages >= $page) {
            foreach ($verses['verses'] as $v) {
                echo sprintf('Fetching chapter: %d, verse: %d...%s', $chapter->getIdentifier(), $v['id'], PHP_EOL);
                $verse = $this->chapterService->getVerseByVerseNumber($v['id']);
                if (!$verse) {
                    $verse = $chapter->addVerse(
                        $v['id'],
                        $v['verse_number'],
                        $v['verse_key'],
                        $v['juz_number'],
                        $v['hizb_number'],
                        $v['rub_el_hizb_number'],
                        $v['ruku_number'],
                        $v['manzil_number'],
                        $v['sajdah_number'],
                        $v['page_number'],
                    );

                    foreach ($v['translations'] as $translation) {
                        $translator = $this->translationService->getByIdentifier($translation['resource_id']);
                        // Api bug verse key translation
                        $verseKey = $translation['verse_key'];
                        if ($translator->getLanguage()->getIsoCode() === Language::BENGALI['iso_code']) {
                            $verseKey = $this->translateVerseKey($translation['verse_key']);
                        }

                        $verse->addTranslation($translation['text'], $verseKey, $translator);
                    }
                }
            }

            ++$page;

            $verses = $this->makeRequest(
                sprintf('/verses/by_chapter/%d', $chapter->getIdentifier()),
                [
                    'words' => false,
                    'page' => $page,
                    'per_page' => 50,
                    'translations' => implode(',', $translators),
                    'translation_fields' => 'verse_key',
                    'fields' => 'text_indopak',
                ]
            );
        }
    }

    private function translateVerseKey(string $verseKey): string
    {
        $verseKey = explode(':', $verseKey);
        $verseKeyFirst = $verseKey[0];
        $verseKeyLast = $verseKey[1];

        $numerals = [
            '0' => '০',
            '1' => '১',
            '2' => '২',
            '3' => '৩',
            '4' => '৪',
            '5' => '৫',
            '6' => '৬',
            '7' => '৭',
            '8' => '৮',
            '9' => '৯',
        ];

        // Translate first part
        $chars = str_split($verseKeyFirst);
        $verseKeyFirst = [];
        foreach ($chars as $char) {
            $verseKeyFirst[] = $numerals[(int) $char];
        }

        // Translate last part
        $chars = str_split($verseKeyLast);
        $verseKeyLast = [];
        foreach ($chars as $char) {
            $verseKeyLast[] = $numerals[(int) $char];
        }

        return sprintf('%s:%s', ...$verseKeyFirst, ...$verseKeyLast);
    }
}
