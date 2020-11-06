<?php

declare(strict_types=1);

namespace App\Domain\Port;

use App\Domain\Port\Command\CommandInterface;

interface CreateProductCommandInterface extends CommandInterface
{
    public function getId(): string;

    public function getName();

    public function getPrice();
}
