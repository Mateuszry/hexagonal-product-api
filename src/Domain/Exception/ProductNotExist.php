<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

final class ProductNotExist extends Exception
{
    public function __construct()
    {
        parent::__construct('Product not exist');
    }
}
