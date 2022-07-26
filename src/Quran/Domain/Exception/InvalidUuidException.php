<?php

namespace App\Quran\Domain\Exception;

class InvalidUuidException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('aggregator_root.exception.invalid_uuid', 400);
    }
}
