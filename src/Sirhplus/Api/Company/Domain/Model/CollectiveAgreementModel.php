<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

class CollectiveAgreementModel extends ValueObject implements MappingRequestInterface
{
    /**
     * @param string $details
     * @param string $idcc
     */
    public function __construct(private string $details, private string $idcc)
    {
    }

    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            $request->details,
            $request->idcc
        );
    }

    /**
     * @return string
     */
    public function details(): string
    {
        return $this->details;
    }

    /**
     * @return string
     */
    public function idcc(): string
    {
        return $this->idcc;
    }
}