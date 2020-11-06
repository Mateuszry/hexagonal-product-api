<?php

declare(strict_types=1);

namespace App\Domain\Port;

interface IdGeneratorInterface
{
    public static function generate(): string;
}
