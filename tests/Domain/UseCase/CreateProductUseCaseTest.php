<?php

declare(strict_types=1);

namespace App\Tests\Domain\UseCase;

use App\Domain\Entity\Product;
use App\Domain\Exception\ValidationException;
use App\Domain\Port\CreateProductCommandInterface;
use App\Domain\Port\Event\EventBusGatewayInterface;
use App\Domain\Port\ProductGatewayInterface;
use App\Domain\Port\ValidatorGatewayInterface;
use App\Domain\UseCase\CreateProductUseCase;
use App\Domain\ValidationViolationList;
use Faker\Provider\Base;
use Faker\Provider\Lorem;
use Faker\Provider\Uuid;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class CreateProductUseCaseTest extends TestCase
{
    public function testCreateProduct()
    {
        $productGateway = $this->createMock(ProductGatewayInterface::class);
        $productGateway->expects(self::once())->method('save')->with(self::isInstanceOf(Product::class));
        $eventBusGateway = $this->createMock(EventBusGatewayInterface::class);
        $eventBusGateway->expects(self::once())->method('publish');

        $createProductCommand = $this->getCreateProductCommandStub(Uuid::uuid(), Lorem::word(), Base::randomFloat(2));

        $createProductUseCase = new CreateProductUseCase(
            $productGateway,
            $eventBusGateway,
            $this->getValidatorGatewayMock(false)
        );
        $createProductUseCase->create($createProductCommand);
    }

    public function testCreateProductValidationViolations()
    {
        $this->expectException(ValidationException::class);
        $productGateway = $this->createMock(ProductGatewayInterface::class);
        $productGateway->expects(self::never())->method('save');
        $eventBusGateway = $this->createMock(EventBusGatewayInterface::class);
        $eventBusGateway->expects(self::never())->method('publish');

        $createProductUseCase = new CreateProductUseCase(
            $productGateway,
            $eventBusGateway,
            $this->getValidatorGatewayMock(true)
        );
        $createProductUseCase->create($this->getCreateProductCommandStub(Uuid::uuid()));
    }

    private function getCreateProductCommandStub(string $id, ?string $name = null, ?float $price = null): Stub
    {
        $stub = $this->createStub(CreateProductCommandInterface::class);
        $stub->method('getId')->willReturn($id);
        $stub->method('getPrice')->willReturn($price);
        $stub->method('getName')->willReturn($name);

        return $stub;
    }

    private function getValidatorGatewayMock(bool $hasViolations): Stub
    {
        $stub = $this->createStub(ValidationViolationList::class);
        $stub->method('hasViolations')->willReturn($hasViolations);

        $mock = $this->createMock(ValidatorGatewayInterface::class);
        $mock->method('validate')->willReturn($stub);

        return $mock;
    }
}
