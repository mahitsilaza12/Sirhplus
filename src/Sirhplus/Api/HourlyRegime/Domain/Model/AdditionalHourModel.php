<?php

namespace Sirhplus\Api\HourlyRegime\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

class AdditionalHourModel extends ValueObject implements MappingRequestInterface
{

    /**
     * @param string $name
     */
    public function __construct(
        public string $name = '',
        public string $companyId = ''
    ) {
    }

    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            $request->name,
            $request->companyId,
        );
    }
}