<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Application\Command\CreateProductCommand;
use App\Application\Query\GetProductQuery;
use App\Domain\Port\Command\CommandBusGatewayInterface;
use App\Domain\Port\Query\QueryBusGatewayInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractFOSRestController
{
    /**
     * @FOSRest\Post("product")
     * @ParamConverter("createProductCommand", converter="fos_rest.request_body")
     */
    public function createAction(
        CreateProductCommand $createProductCommand,
        CommandBusGatewayInterface $commandBusGateway,
        QueryBusGatewayInterface $queryBusGateway
    ): Response {
        $commandBusGateway->dispatch($createProductCommand);
        $presenter = $queryBusGateway->ask(new GetProductQuery($createProductCommand->getId()));

        return $this->handleView($this->view($presenter, Response::HTTP_CREATED));
    }
}
