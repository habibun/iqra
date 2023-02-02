<?php

namespace App\Shared\Presentation\Controller;

use App\Shared\Application\Dto\SignUpUserRequest;
use App\Shared\Application\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function signUp(Request $request)
    {
        $data = $request->toArray();
        $signUpUserRequest = new SignUpUserRequest(
            $data['name'],
            $data['email'],
            $data['password']
        );

        $this->userService->signUp($signUpUserRequest);

        return $this->json([]);
    }
}
