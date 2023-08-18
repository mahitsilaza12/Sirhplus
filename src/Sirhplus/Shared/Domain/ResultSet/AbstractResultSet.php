<?php

namespace Sirhplus\Shared\Domain\ResultSet;

/**
 * class AbstractResultSet
 */
abstract class AbstractResultSet
{
    /**
     * @param array $data
     * @param int $total
     */
    public function __construct(protected array $data, protected int $total)
    {
    }

    /**
     * @return array
     */
    public abstract function getData(): array;

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
