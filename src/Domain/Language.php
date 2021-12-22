<?php

namespace App\Domain;

class Language
{
    public const ISO_CODE_ENGLISH = 'en';
    public const ISO_CODE_BENGALI = 'bn';

    private int $id;
    private string $name;
    private string $nativeName;
    private string $isoCode;
    private string $direction;
    private translatedName $translatedName;

    public static function getPreDefinedLanguage()
    {
        return [
            'English' => Language::ISO_CODE_ENGLISH,
            'Bengali' => Language::ISO_CODE_BENGALI,
        ];
    }
}
