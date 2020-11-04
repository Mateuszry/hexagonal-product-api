<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Product
{
    public string $id;
    public string $name;
    public int $price;

    public function __construct(string $name, int $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}
