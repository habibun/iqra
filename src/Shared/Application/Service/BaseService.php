<?php

namespace App\Shared\Application\Service;

use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

class BaseService
{
    protected function getNextIdentity(): Uuid
    {
        return BaseRepository::getNextIdentity();
    }
}
