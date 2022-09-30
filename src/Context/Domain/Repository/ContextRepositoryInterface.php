<?php

namespace App\Context\Domain\Repository;

use App\Context\Domain\Model\Context;
use App\Shared\Domain\ValueObject\Uuid;

interface ContextRepositoryInterface
{
    public function add(Context $context);

    public function nextIdentity(): Uuid;
}
