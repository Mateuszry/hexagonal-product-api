<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Adapter\CreateProduct;
use App\Application\Presenter\ProductPresenter;
use App\Domain\UseCase\CreateProductUseCase;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ProductController extends AbstractFOSRestController
{
    /**
     * @FOSRest\Post("product")
     * @ParamConverter("createProduct", converter="fos_rest.request_body")
     */
    public function createAction(
        CreateProduct $createProduct,
        CreateProductUseCase $createProductUseCase,
        ConstraintViolationListInterface $validationErrors
    ): Response {
        if (count($validationErrors) > 0) {
            return $this->handleView($this->view($validationErrors, Response::HTTP_BAD_REQUEST));
        }

        $product = $createProductUseCase->create($createProduct);

        return $this->handleView($this->view(new ProductPresenter($product), Response::HTTP_CREATED));
    }
}
