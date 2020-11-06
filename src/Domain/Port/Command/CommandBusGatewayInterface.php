<?php

declare(strict_types=1);

namespace App\Domain\Port\Command;

interface CommandBusGatewayInterface
{
    public function dispatch(CommandInterface $command): void;
}
