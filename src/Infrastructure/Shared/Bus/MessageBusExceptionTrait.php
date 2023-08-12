<?php

namespace App\Infrastructure\Shared\Bus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Throwable;
trait MessageBusExceptionTrait
{
    public function throwException(HandlerFailedException $exception): void
    {
        while ($exception instanceof HandlerFailedException) {
            /** @var Throwable $exception */
            $exception = $exception->getPrevious();
        }

        throw $exception;
    }
}