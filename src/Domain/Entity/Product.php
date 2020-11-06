<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Product
{
    private string $id;
    private string $name;
    private int $price;

    public function __construct(string $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $this->convertToCents($price);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPriceInDollars(): float
    {
        return $this->convertToDollars($this->price);
    }

    public function getPriceInCents(): int
    {
        return $this->price;
    }

    private function convertToCents(float $price): int
    {
        return (int) ($price * 100);
    }

    private function convertToDollars(int $price): float
    {
        return (float) ($price / 100);
    }
}
