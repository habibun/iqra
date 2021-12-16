<?php

namespace App\Application\Service;

use App\Domain\Quran as QuranEntity;
use App\Infrastructure\Persistence\Doctrine\Repository\QuranRepository;

class QuranService
{
    private QuranRepository $quran;

    public function __construct(QuranRepository $quran)
    {
        $this->quran = $quran;
    }

    public function create(array $data)
    {
        dd($data);
        $quran = new QuranEntity();

        //todo - add logic
        try {
            $this->quran->store($quran);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
