<?php

namespace App\Domain;

class Format
{
    public const TEXT = 1;
    public const AUDIO = 2;

    private int $id;
    private int $name;
}
