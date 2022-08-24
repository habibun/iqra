<?php

namespace App\Quran\Presentation\Api;

use App\Quran\Application\Service\ChapterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ChapterController extends AbstractController
{
    private ChapterService $chapterService;

    public function __construct(ChapterService $chapterService)
    {
        $this->chapterService = $chapterService;
    }

    public function list(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->chapterService->getList($request->getLocale())
        );
    }

    public function randomVerse(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->chapterService->getRandomVerse($request->getLocale())
        );
    }
}
