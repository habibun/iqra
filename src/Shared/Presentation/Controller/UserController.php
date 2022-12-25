<?php

namespace App\Shared\Presentation\Controller;

use App\Shared\Application\Dto\SignUpUserRequest;
use App\Shared\Application\Service\UserService;
use App\Shared\Domain\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    public function signIn(TokenStorageInterface $tokenStorage,)
    {
        if (null === $this->getUser()) {
            return $this->json([
                   'message' => 'missing credentials',
               ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $tokenStorage->getToken();

        return $this->json([
             'message' => 'Welcome to your new controller!',
             'path' => 'src/Controller/ApiLoginController.php',
             'user'  => $this->getUser()->getUserIdentifier(),
            'token' => $token,
        ]);

    }
}
