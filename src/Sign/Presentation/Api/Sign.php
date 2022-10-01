<?php

namespace App\Sign\Presentation\Api;

use App\Context\Application\Service\GroupService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SignController extends AbstractController
{
    private GroupService $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function list(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->groupService->getList($request->getLocale())
        );
    }

    public function details(string $id, Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->groupService->getByIdAndLanguageIso($id, $request->getLocale())
        );
    }
}
