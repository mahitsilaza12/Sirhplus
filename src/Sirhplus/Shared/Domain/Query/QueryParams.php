<?php

namespace Sirhplus\Shared\Domain\Query;

/**
 * interface QueryParams
 */
interface QueryParams
{
    /**
     * @return string
     */
    public function getPredicates(): string;

    /**
     * @return array
     */
    public function getParameters(): array;
}
