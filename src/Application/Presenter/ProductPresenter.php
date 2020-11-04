<?php

declare(strict_types=1);

namespace App\Application\Presenter;

use App\Domain\Entity\Product as DomainProduct;

class ProductPresenter extends Presenter
{
    public function __construct(DomainProduct $product)
    {
        parent::__construct(new Product($product));
    }
}
