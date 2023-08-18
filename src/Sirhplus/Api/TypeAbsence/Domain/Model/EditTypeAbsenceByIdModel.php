<?php

namespace Sirhplus\Api\TypeAbsence\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class EditTypeAbsenceByIdModel
 */
final class EditTypeAbsenceByIdModel extends ValueObject implements Request
{
    /**
     * @param string $type
     * @param string $color
     * @param boolean $visibility
     */
    public function __construct(
        public string $type = '',
        public string $color = '',
        public bool $visibility = false
    ) {
    }

    /**
     * @param Request $request
     * @return EditTypeAbsenceByIdModel
     */
    public static function create(Request $request): EditTypeAbsenceByIdModel
    {
        return new self(
            $request->type,
            $request->color,
            $request->visibility,
        );
    }
}