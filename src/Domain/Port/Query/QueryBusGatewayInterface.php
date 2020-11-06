<?php

declare(strict_types=1);

namespace App\Domain\Port\Query;

use App\Application\Presenter\DataPresenterInterface;

interface QueryBusGatewayInterface
{
    public function ask(QueryInterface $query): ?DataPresenterInterface;
}
