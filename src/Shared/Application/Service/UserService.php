<?php

namespace App\Shared\Application\Service;

use App\Shared\Application\Dto\SignUpUserRequest;
use App\Shared\Application\Dto\SignUpUserResponse;
use App\Shared\Domain\Exception\UserAlreadyExistsException;
use App\Shared\Domain\Model\User;
use App\Shared\Domain\Repository\UserRepositoryInterface;

class UserService extends BaseService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signUp(SignUpUserRequest $request): SignUpUserResponse
    {
        $name = $request->name();
        $email = $request->email();
        $password = $request->password();

        $user = $this->userRepository->getByEmail($email);
        if ($user) {
            throw new UserAlreadyExistsException();
        }

        $user = User::create($this->getNextIdentity(), $name, $email);
        $this->userRepository->add($user);

        return new SignUpUserResponse($user);
    }
}
