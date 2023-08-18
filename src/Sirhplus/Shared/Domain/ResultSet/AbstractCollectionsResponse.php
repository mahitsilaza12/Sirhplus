<?php

namespace Sirhplus\Shared\Domain\ResultSet;

use Sirhplus\Shared\Service\Response;

abstract class AbstractCollectionsResponse implements Response
{
    /**
     * @param array $data
     * @param int $total
     * @param int $page
     * @param int $size
     */
    public function __construct(
        protected array $data,
        protected int $total,
        protected int $page,
        protected int $size
    ) {
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return [
            'data' => $this->data,
            'meta' => $this->getMeta(),
        ];
    }

    /**
     * @return array
     */
    private function getMeta(): array
    {
        return [
            'total_page' => 0 === $this->size ? 0 : ceil($this->total / $this->size),
        ];
    }
}
