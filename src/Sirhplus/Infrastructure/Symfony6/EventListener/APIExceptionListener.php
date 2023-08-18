<?php

namespace Symfony6\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * class APIExceptionListener
 */
final class APIExceptionListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $code = 0 !== $exception->getCode() ? $exception->getCode() : Response::HTTP_BAD_REQUEST;

        $data = [
            'code' => $code,
            'message' => $exception->getMessage(),
        ];
        $event->setResponse(new JsonResponse($data, $code));
    }
}
