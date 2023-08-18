<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

class CompanyActivityModel extends ValueObject implements MappingRequestInterface
{
    /**
     * @param string $sector
     * @param string $code
     */
    public function __construct(private string $sector, private string $code)
    {
    }

    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            $request->sector,
            $request->code
        );
    }

    /**
     * @return string
     */
    public function sector(): string
    {
        return $this->sector;
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }
}