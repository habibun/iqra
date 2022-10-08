<?php

namespace App\Shared\Application\Service;

use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

class BaseService
{
    protected function getNextIdentity(): Uuid
    {
        return Uuid::fromString((string) SymfonyUuid::v4());
    }
}
