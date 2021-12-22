<?php

namespace App\Domain\Chapter;

use App\Domain\Chapter;

class Recitation
{
    private int $id;
    private int $fileSize;
    private string $format;
    private int $totalFiles;
    private string $audioUrl;
    private Chapter $chapter;
}
