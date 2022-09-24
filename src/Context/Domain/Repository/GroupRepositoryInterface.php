<?php

namespace App\Context\Domain\Repository;

use App\Context\Domain\Model\Group;

interface GroupRepositoryInterface
{
    public function add(Group $group);
}
