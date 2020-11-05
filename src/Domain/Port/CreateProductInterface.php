<?php

declare(strict_types=1);

namespace App\Domain\Port;

interface CreateProductInterface
{
    public function getName();

    public function getPrice();
}
