<?php

namespace Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceById;

use Sirhplus\Shared\Service\Response;

/**
 * class ShowTypeAbsenceByIdResponse
 */
final class ShowTypeAbsenceByIdResponse implements Response
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
            'uuid' => $this->object->getId()->toRfc4122(),
            'type' => $object->getType(),
            'color' => $object->getColor(),
            'visibility' => $object->isVisibility(),
            'protected' => $object->isProtected(),
        ];
    }
}