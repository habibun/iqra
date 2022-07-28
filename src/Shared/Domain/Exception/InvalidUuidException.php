<?php

namespace App\Shared\Domain\Exception;

class InvalidUuidException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Invalid UUID', 400);
    }
}
