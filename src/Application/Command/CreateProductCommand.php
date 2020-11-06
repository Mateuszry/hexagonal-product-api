<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Port\CreateProductCommandInterface;
use App\Infrastructure\IdGenerator;
use Symfony\Component\Validator\Constraints as Assert;

class CreateProductCommand implements CreateProductCommandInterface
{
    public string $id;

    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 255)
     */
    public $name;

    /**
     * @Assert\Type("float")
     * @Assert\NotBlank
     * @Assert\PositiveOrZero()
     */
    public $price;

    public function __construct($name = null, $price = null)
    {
        $this->id = IdGenerator::generate();
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
