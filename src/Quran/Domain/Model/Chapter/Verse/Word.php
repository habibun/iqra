<?php

namespace App\Quran\Domain\Model\Chapter\Verse;

class Word
{
    private int $id;
    private int $position;
    private string $audio_url;
    private string $char_type_name;
    private string $code_v1;
    private int $page_number;
    private int $line_number;
    private string $text;

}
