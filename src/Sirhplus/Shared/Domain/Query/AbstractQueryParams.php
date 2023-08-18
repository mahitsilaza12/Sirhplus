<?php

namespace Sirhplus\Shared\Domain\Query;

/**
 * class AbstractQueryParams
 */
abstract class AbstractQueryParams
{
    /**
     * ShowOfferQuery constructor.
     * @param $page
     * @param $size
     * @param array $fields
     * @param array $filters
     * @param array $sort
     */
    public function __construct(
        public int $page,
        public int $size,
        public array $fields,
        public array $filters,
        public array $sort
    ) {
    }

    public function page(): int
    {
        return $this->page;
    }

    public function size(): int
    {
        return $this->size;
    }

    /**
     * @return string[]
     */
    public function filters(): array
    {
        return $this->filters;
    }

    /**
     * @return string[]
     */
    public function fields(): array
    {
        return $this->fields;
    }

    /**
     * @return string[]
     */
    public function sort(): array
    {
        return $this->sort;
    }
}

