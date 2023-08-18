<?php

namespace Sirhplus\Api\Functions\Application\GetFunctionById;

use Sirhplus\Shared\Service\Response;

/**
 * class GetFunctionByIdResponse
 */
final class GetFunctionByIdResponse implements Response
{
    /** @var array  */
    private array $data = [];

    /**
     * @param object $object
     */
    public function __construct(private readonly object $object)
    {
        $this->data = [];
        $this->mapping();
    }

    /**
     * @param object $object
     * @return array
     */
    public function getContent(): array
    {
        return $this->data;
    }

    private function mapping(): void
    {
        $object = $this->object;
        $this->data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
        ];
    }
}
