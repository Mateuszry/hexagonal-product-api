<?php

declare(strict_types=1);

namespace App\Application\Presenter;

use App\Domain\Entity\Product as DomainProduct;

class Product
{
    public string $id;
    public string $name;
    public int $price;

    public function __construct(DomainProduct $product)
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
    }
}
