<?php

namespace Sirhplus\Api\TypeAbsence\Application\AddTypeAbsence;

use Sirhplus\Shared\Service\Response;

/**
 * class AddTypeAbsenceResponse
 */
final class AddTypeAbsenceResponse implements Response
{
    /**
     * @param object $object
     */
    public function __construct(private readonly object $object)
    {
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return [
            'id' => $this->object->getId()->toRfc4122(),
            'type' => $this->object->getType(),
            'color' => $this->object->getColor(),
            'visibility' => $this->object->isVisibility()
        ];
    }
}