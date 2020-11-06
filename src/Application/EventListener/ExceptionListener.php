<?php

declare(strict_types=1);

namespace App\Application\EventListener;

use App\Domain\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Throwable;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        if ($exception instanceof ValidationException) {
            $response = new JsonResponse([
                'data' => [
                    'violations' => $exception->validationViolationList->getViolations(),
                ],
            ], JsonResponse::HTTP_BAD_REQUEST);
        } else {
            $response = new JsonResponse(
                [
                    'data' => [
                        'message' => $exception->getMessage(),
                    ],
                ],
                $this->getStatus($exception)
            );
        }

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
