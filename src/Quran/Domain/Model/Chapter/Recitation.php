<?php

namespace App\Quran\Domain\Model\Chapter;

use App\Quran\Domain\Model\Chapter;

class Recitation
{
    private int $id;
    private int $fileSize;
    private string $format;
    private int $totalFiles;
    private string $audioUrl;
    private Chapter $chapter;
}
