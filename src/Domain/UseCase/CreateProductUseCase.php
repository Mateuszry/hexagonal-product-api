<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Application\Adapter\CreateProduct;
use App\Domain\Entity\Product;
use App\Domain\Port\ProductGatewayInterface;

class CreateProductUseCase
{
    private ProductGatewayInterface $productGateway;

    public function __construct(ProductGatewayInterface $productGateway)
    {
        $this->productGateway = $productGateway;
    }

    public function create(CreateProduct $createProduct): Product
    {
        $product = new Product($createProduct->name, $createProduct->price);
        $this->productGateway->save($product);

        return $product;
    }
}
