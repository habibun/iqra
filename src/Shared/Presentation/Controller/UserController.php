<?php

namespace App\Shared\Presentation\Controller;

use App\Shared\Application\Dto\SignUpUserRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    public function signUpAction(Request $request)
    {
        $signUpUserRequest = new SignUpUserRequest(
            $request->get('name'),
            $request->get('email'),
            $request->get('password')
        );
    }
}
