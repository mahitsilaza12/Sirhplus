<?php

namespace Sirhplus\Shared\Domain\Exception;

use Sirhplus\Shared\Domain\ValueObject\Uuid;

/**
 * class ObjectNotFound
 */
final class ObjectNotFound extends DomainError
{
    public function __construct(private readonly Uuid $uuid, private readonly string $entityClass)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'object_not_found';
    }

    protected function errorMessage(): string
    {
        $proxyClass = new \ReflectionClass($this->entityClass);

        return sprintf('%s <%s> has not been found', $proxyClass->getShortName(), $this->uuid->toRfc4122());
    }
}
