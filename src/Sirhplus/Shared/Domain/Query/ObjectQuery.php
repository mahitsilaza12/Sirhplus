<?php

namespace Sirhplus\Shared\Domain\Query;

/**
 * interface class
 */
final class ObjectQuery
{
    /**
     * @param array $object
     * @param int $total
     */
    public function __construct(private readonly array $object, private readonly int $total = 0)
    {
    }

    /**
     * @return array
     */
    public function getObjects(): array
    {
        return $this->object;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
