<?php

declare(strict_types=1);

namespace App\Domain\Port\Event;

interface EventInterface
{
    public static function eventName(): string;

    public function getData(): array;
}
