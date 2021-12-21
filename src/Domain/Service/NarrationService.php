<?php

namespace App\Domain\Service;

use App\Domain\Narration;
use App\Domain\Repository\NarrationRepositoryInterface;

class NarrationService implements NarrationServiceInterface
{
    private NarrationRepositoryInterface $narrationRepository;

    public function __construct(NarrationRepositoryInterface $narrationRepository)
    {
        $this->narrationRepository = $narrationRepository;
    }

    public function create(string $name, string $englishName)
    {
        $narration = (new Narration())
            ->setName($name)
            ->setEnglishName($englishName)
        ;
        $this->narrationRepository->add($narration);

        return $narration;
    }
}
