<?php

declare(strict_types=1);

namespace App\Domain\Port\Event;

interface EventBusGatewayInterface
{
    public function publish(EventInterface $event): void;
}
