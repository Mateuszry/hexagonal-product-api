<?php

declare(strict_types=1);

namespace App\Tests\Domain\UseCase;

use App\Application\Adapter\CreateProduct;
use App\Domain\Entity\Product;
use App\Domain\Port\ProductGatewayInterface;
use App\Domain\UseCase\CreateProductUseCase;
use Faker\Provider\Base;
use Faker\Provider\Lorem;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class CreateProductUseCaseTest extends TestCase
{
    public function testCreateProduct()
    {
        $name = Lorem::word();
        $price = Base::randomNumber();
        $productGateway = $this->createMock(ProductGatewayInterface::class);
        $productGateway->expects(self::once())->method('save')->with(self::isInstanceOf(Product::class));
        $createProduct = $this->getCreateProductStub($name, $price);

        $createProductUseCase = new CreateProductUseCase($productGateway);
        $product = $createProductUseCase->create($createProduct);

        self::assertEquals($name, $product->name);
        self::assertEquals($price, $product->price);
    }

    private function getCreateProductStub(?string $name, ?int $price): Stub
    {
        $stub = $this->createStub(CreateProduct::class);
        $stub->price = $price;
        $stub->name = $name;

        return $stub;
    }
}
