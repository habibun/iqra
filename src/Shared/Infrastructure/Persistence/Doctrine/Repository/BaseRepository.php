<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine\Repository;

use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

class BaseRepository
{
    public static function getNextIdentity(): Uuid
    {
        return Uuid::fromString((string) SymfonyUuid::v4());
    }
}
