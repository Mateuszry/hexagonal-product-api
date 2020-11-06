<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\Presenter\DataPresenterInterface;
use App\Application\Query\GetProductQuery;
use App\Application\Query\GetProductQueryHandler;
use App\Domain\Port\ProductGatewayInterface;
use App\Domain\Port\Query\QueryBusGatewayInterface;
use App\Domain\Port\Query\QueryInterface;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class QueryBus implements QueryBusGatewayInterface
{
    private MessageBus $bus;

    public function __construct(ProductGatewayInterface $productGateway)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator([
                        GetProductQuery::class => [new GetProductQueryHandler($productGateway)],
                    ])
                ),
            ]
        );
    }

    public function ask(QueryInterface $query): ?DataPresenterInterface
    {
        /** @var HandledStamp $stamp */
        $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

        return $stamp->getResult();
    }
}
