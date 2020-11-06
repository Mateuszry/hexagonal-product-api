<?php

declare(strict_types=1);

namespace App\Application\Presenter;

use App\Domain\Entity\Product as DomainProduct;

class ProductPresenter implements DataPresenterInterface
{
    public string $id;
    public string $name;
    public float $price;

    public function __construct(DomainProduct $product)
    {
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->price = $product->getPriceInDollars();
    }
}
