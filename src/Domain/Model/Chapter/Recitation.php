<?php

namespace App\Domain\Model\Chapter;

use App\Domain\Model\Chapter;

class Recitation
{
    private int $id;
    private int $fileSize;
    private string $format;
    private int $totalFiles;
    private string $audioUrl;
    private Chapter $chapter;
}
