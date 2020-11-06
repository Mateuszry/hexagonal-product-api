<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\Port\Event\EventInterface;
use App\Infrastructure\IdGenerator;
use DateTimeImmutable;

abstract class Event implements EventInterface
{
    public string $aggregateId;
    public string $eventId;
    public DateTimeImmutable $occurredOn;

    public function __construct(string $aggregateId, DateTimeImmutable $occurredOn = null)
    {
        $this->aggregateId = $aggregateId;
        $this->eventId = IdGenerator::generate();
        $this->occurredOn = $occurredOn ?: new DateTimeImmutable();
    }

    abstract public static function eventName(): string;

    public function getData(): array
    {
        return [
            'aggregateId' => $this->aggregateId,
            'eventId' => $this->eventId,
            'occurredOn' => $this->occurredOn,
        ];
    }
}
