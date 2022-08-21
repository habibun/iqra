<?php

namespace App\Quran\Presentation\Api;

use App\Quran\Application\Service\ChapterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class VerseController extends AbstractController
{
    private ChapterService $chapterService;

    public function __construct(ChapterService $chapterService)
    {
        $this->chapterService = $chapterService;
    }

    public function random(): JsonResponse
    {
        return new JsonResponse(
            $this->chapterService->getRandomVerse()
        );
    }
}
