<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Port\Command\CommandHandlerInterface;
use App\Domain\Port\CreateProductCommandInterface;
use App\Domain\UseCase\CreateProductUseCase;

class CreateProductCommandHandler implements CommandHandlerInterface
{
    private CreateProductUseCase $createProductUseCase;

    public function __construct(CreateProductUseCase $createProductUseCase)
    {
        $this->createProductUseCase = $createProductUseCase;
    }

    public function __invoke(CreateProductCommandInterface $createProduct): void
    {
        $this->createProductUseCase->create($createProduct);
    }
}
