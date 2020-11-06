<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\Event\CreatedProductEventHandler;
use App\Domain\Event\ProductCreatedEvent;
use App\Domain\Port\Event\EventBusGatewayInterface;
use App\Domain\Port\Event\EventInterface;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class EventBus implements EventBusGatewayInterface
{
    private MessageBus $messageBus;

    public function __construct()
    {
        $this->messageBus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator([
                            ProductCreatedEvent::class => [new CreatedProductEventHandler()],
                        ]
                    )
                ),
            ]
        );
    }

    public function publish(EventInterface $event): void
    {
        $this->messageBus->dispatch($event);
    }
}
