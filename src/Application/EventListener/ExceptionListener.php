<?php

declare(strict_types=1);

namespace App\Application\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $response = new JsonResponse(
            [
                'data' => [
                    'message' => $exception->getMessage(),
                ],
            ],
            $this->getStatus($exception)
        );

        $event->setResponse($response);
    }

    private function getStatus(Throwable $exception): int
    {
        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }

        return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
    }
}
