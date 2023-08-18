<?php

namespace Sirhplus\Api\TypeAbsence\Application\EditTypeAbsenceById;

use Sirhplus\Shared\Service\Response;

/**
 * class EditTypeAbsenceByIdResponse
 */
final class EditTypeAbsenceByIdResponse implements Response
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
        ];
    }
}