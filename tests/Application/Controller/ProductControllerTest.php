<?php

declare(strict_types=1);

namespace App\Tests\Application\Controller;

use Faker\Provider\Base;
use Faker\Provider\Lorem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductControllerTest extends ControllerTestCase
{
    public function testProductCreated(): void
    {
        $name = Lorem::word();
        $price = Base::randomNumber();

        $content = [
            'name' => $name,
            'price' => $price,
        ];

        $this->sendRequest(Request::METHOD_POST, 'product', $content);
        self::assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertResponseContentMatchesPattern('
        {
          "data": {
            "id": "@uuid@",
            "name": "@string@",
            "price": "@integer@"
          }
        }
        ');
    }

    public function testCreateProductEmptyContent(): void
    {
        $this->sendRequest(Request::METHOD_POST, 'product');
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertResponseContentMatchesPattern('
        {
          "data": {
            "violations": {
              "name": [
                "This value should not be blank."
              ],
              "price": [
                "This value should not be blank."
              ]
            }
          }
        }
        ');
    }

    public function testCreateProductNegativePrice(): void
    {
        $content = [
            'name' => Lorem::word(),
            'price' => Base::numberBetween(-10000, -1),
        ];

        $this->sendRequest(Request::METHOD_POST, 'product', $content);
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertResponseContentMatchesPattern('
        {
          "data": {
            "violations": {
              "price": [
                "This value should be either positive or zero."
              ]
            }
          }
        }
        ');
    }

    public function testCreateProductNameTooShort(): void
    {
        $content = [
            'name' => Base::randomLetter(),
            'price' => Base::randomNumber(),
        ];

        $this->sendRequest(Request::METHOD_POST, 'product', $content);
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertResponseContentMatchesPattern('
        {
          "data": {
            "violations": {
              "name": [
                "This value is too short. It should have 2 characters or more."
              ]
            }
          }
        }
        ');
    }

    public function testCreateProductNameTooLong(): void
    {
        $content = [
            'name' => str_repeat(Base::randomLetter(), 256),
            'price' => Base::randomNumber(),
        ];

        $this->sendRequest(Request::METHOD_POST, 'product', $content);
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertResponseContentMatchesPattern('
        {
          "data": {
            "violations": {
              "name": [
                "This value is too long. It should have 255 characters or less."
              ]
            }
          }
        }
        ');
    }

    public function testCreateProductInvalidContentTypes(): void
    {
        $content = [
            'name' => Base::randomNumber(2),
            'price' => Base::randomLetter(),
        ];

        $this->sendRequest(Request::METHOD_POST, 'product', $content);
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
        $this->assertResponseContentMatchesPattern('
        {
          "data": {
            "violations": {
              "name": [
                "This value should be of type string."
              ],
              "price": [
                "This value should be of type int."
              ]
            }
          }
        }
        ');
    }
}
