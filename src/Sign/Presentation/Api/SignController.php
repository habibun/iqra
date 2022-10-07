<?php

namespace App\Sign\Presentation\Api;

use App\Sign\Application\Service\SignService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SignController extends AbstractController
{
    private SignService $signService;

    public function __construct(SignService $signService)
    {
        $this->signService = $signService;
    }

    public function list(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->signService->getList($request->getLocale())
        );
    }

    public function details(string $id, Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->signService->getByIdAndLanguageIso($id, $request->getLocale())
        );
    }
}
