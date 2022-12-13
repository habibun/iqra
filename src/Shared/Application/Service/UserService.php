<?php

namespace App\Shared\Application\Service;

use App\Shared\Application\Dto\SignUpUserRequest;
use App\Shared\Domain\Exception\UserAlreadyExistsException;
use App\Shared\Domain\Model\User;
use App\Shared\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserService extends BaseService
{
    private UserRepositoryInterface $userRepository;
    private EntityManagerInterface $em;

    public function __construct(UserRepositoryInterface $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function signUp(SignUpUserRequest $request)
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
        $this->em->flush();
    }
}
