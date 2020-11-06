<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Entity\Product;
use App\Domain\Event\ProductCreatedEvent;
use App\Domain\Exception\ValidationException;
use App\Domain\Port\CreateProductCommandInterface;
use App\Domain\Port\Event\EventBusGatewayInterface;
use App\Domain\Port\ProductGatewayInterface;
use App\Domain\Port\ValidatorGatewayInterface;

class CreateProductUseCase
{
    private ProductGatewayInterface $productGateway;
    private EventBusGatewayInterface $eventBusGateway;
    private ValidatorGatewayInterface $validatorGatewayInterface;

    public function __construct(
        ProductGatewayInterface $productGateway,
        EventBusGatewayInterface $eventBusGateway,
        ValidatorGatewayInterface $validatorGatewayInterface
    ) {
        $this->productGateway = $productGateway;
        $this->eventBusGateway = $eventBusGateway;
        $this->validatorGatewayInterface = $validatorGatewayInterface;
    }

    public function create(CreateProductCommandInterface $createProduct): void
    {
        $validationViolationList = $this->validatorGatewayInterface->validate($createProduct);
        if ($validationViolationList->hasViolations()) {
            throw new ValidationException($validationViolationList);
        }
        $product = new Product($createProduct->getId(), $createProduct->getName(), $createProduct->getPrice());
        $this->productGateway->save($product);
        $this->eventBusGateway->publish(
            new ProductCreatedEvent($product->getId(), $product->getName(), $product->getPriceInDollars())
        );
    }
}
