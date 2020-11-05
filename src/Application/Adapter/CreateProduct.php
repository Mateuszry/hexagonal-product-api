<?php

declare(strict_types=1);

namespace App\Application\Adapter;

use App\Domain\Port\CreateProductInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateProduct implements CreateProductInterface
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 255)
     */
    public $name;

    /**
     * @Assert\Type("int")
     * @Assert\NotBlank
     * @Assert\PositiveOrZero()
     */
    public $price;

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
