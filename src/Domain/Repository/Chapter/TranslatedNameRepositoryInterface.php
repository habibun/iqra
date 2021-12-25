<?php

namespace App\Domain\Repository\Chapter;

use App\Domain\Model\Chapter\TranslatedName;

interface TranslatedNameRepositoryInterface
{
    public function add(TranslatedName $language);
}
