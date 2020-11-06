<?php

declare(strict_types=1);

namespace App\Domain\Event;

use DateTimeImmutable;

final class ProductCreatedEvent extends Event
{
    private string $name;
    private float $price;

    public function __construct(string $id, string $name, float $price, DateTimeImmutable $occurredOn = null)
    {
        parent::__construct($id, $occurredOn);

        $this->price = $price;
        $this->name = $name;
    }

    public static function eventName(): string
    {
        return 'product.created';
    }

    public function getData(): array
    {
        $data = [
            'name' => $this->name,
            'price' => $this->price,
        ];

        return $data + parent::getData();
    }
}
