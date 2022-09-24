<?php

namespace App\Context\Presentation\Api;

use App\Context\Application\Service\ContextService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContextController extends AbstractController
{
    private ContextService $contextService;

    public function __construct(ContextService $contextService)
    {
        $this->contextService = $contextService;
    }

    public function list(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->contextService->getList($request->getLocale())
        );
    }

    public function randomVerse(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->contextService->getRandomVerse($request->getLocale())
        );
    }

    public function details(int $id, Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->contextService->getByIdentifierAndTranslatorIdentifier($id, $request->getLocale())
        );
    }
}
