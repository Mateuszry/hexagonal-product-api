<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Entity\Product;
use App\Domain\Port\CreateProductInterface;
use App\Domain\Port\ProductGatewayInterface;

class CreateProductUseCase
{
    private ProductGatewayInterface $productGateway;

    public function __construct(ProductGatewayInterface $productGateway)
    {
        $this->productGateway = $productGateway;
    }

    public function create(CreateProductInterface $createProduct): Product
    {
        $product = new Product($createProduct->getName(), $createProduct->getPrice());
        $this->productGateway->save($product);

        return $product;
    }
}
