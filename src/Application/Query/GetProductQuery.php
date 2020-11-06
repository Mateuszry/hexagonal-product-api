<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Port\Query\QueryInterface;

class GetProductQuery implements QueryInterface
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
