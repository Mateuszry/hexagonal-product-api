<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Presenter\DataPresenterInterface;
use App\Application\Presenter\ProductPresenter;
use App\Domain\Exception\ProductNotExist;
use App\Domain\Port\ProductGatewayInterface;
use App\Domain\Port\Query\QueryHandlerInterface;

class GetProductQueryHandler implements QueryHandlerInterface
{
    private ProductGatewayInterface $productGateway;

    public function __construct(ProductGatewayInterface $productGateway)
    {
        $this->productGateway = $productGateway;
    }

    public function __invoke(GetProductQuery $query): DataPresenterInterface
    {
        $product = $this->productGateway->findById($query->id);

        if (null === $product) {
            throw new ProductNotExist();
        }

        return new ProductPresenter($product);
    }
}
