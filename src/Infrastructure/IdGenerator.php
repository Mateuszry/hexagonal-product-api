<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Port\IdGeneratorInterface;
use Symfony\Component\Uid\Uuid;

class IdGenerator implements IdGeneratorInterface
{
    public static function generate(): string
    {
        return (string) Uuid::v4();
    }
}
