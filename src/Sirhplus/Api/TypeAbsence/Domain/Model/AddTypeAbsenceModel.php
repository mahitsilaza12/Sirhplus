<?php

namespace Sirhplus\Api\TypeAbsence\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\Request;

/**
 * class AddTypeAbsenceModel
 */
final class AddTypeAbsenceModel extends ValueObject implements Request
{

    /**
     * @param string $type
     * @param string $color
     * @param boolean $visibility
     * @param string $companyId
     */
    public function __construct(
        public string $type = '',
        public string $color = '',
        public bool $visibility = false,
        public string $companyId = '',

    ) 
    {
    }

    /**
     * @param Request $request
     * @return AddTypeAbsenceModel
     */
    public static function create(Request $request): AddTypeAbsenceModel
    {
        return new self(
            $request->type,
            $request->color,
            $request->visibility,
            $request->companyId
        );
    }
}