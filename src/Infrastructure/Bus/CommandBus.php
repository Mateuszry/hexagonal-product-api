<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\Command\CreateProductCommand;
use App\Application\Command\CreateProductCommandHandler;
use App\Domain\Port\Command\CommandBusGatewayInterface;
use App\Domain\Port\Command\CommandInterface;
use App\Domain\UseCase\CreateProductUseCase;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class CommandBus implements CommandBusGatewayInterface
{
    private MessageBus $bus;

    public function __construct(CreateProductUseCase $createProductUseCase)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator([
                        CreateProductCommand::class => [new CreateProductCommandHandler($createProductUseCase)],
                    ])
                ),
            ]
        );
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->bus->dispatch($command);
    }
}
