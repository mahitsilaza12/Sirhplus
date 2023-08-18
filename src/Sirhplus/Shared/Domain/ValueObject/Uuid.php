<?php

namespace Sirhplus\Shared\Domain\ValueObject;

use Symfony\Component\Uid\Uuid as SymfonyUuid;
use Stringable;

/**
 * class Uuid
 */
class Uuid extends SymfonyUuid implements Stringable
{
    /**
     * @param string $uuid
     */
    public function __construct(protected string $uuid)
    {
        parent::__construct($uuid);
        $this->ensureIsValidUuid($uuid);
    }

    /**
     * @return static
     */
    public static function random(): self
    {
        return new static(SymfonyUuid::v4()->__toString());
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @param string $id
     * @return void
     */
    private function ensureIsValidUuid(string $id): void
    {
        if (!SymfonyUuid::isValid($id)) {
            throw new \InvalidArgumentException(sprintf(
                '<%s> does not allow the value <%s>.',
                static::class,
                $id)
            );
        }
    }
}
