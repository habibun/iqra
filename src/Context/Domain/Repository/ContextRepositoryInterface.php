<?php

namespace App\Context\Domain\Repository;

use App\Context\Domain\Model\Context;

interface ContextRepositoryInterface
{
    public function add(Context $context);
}
