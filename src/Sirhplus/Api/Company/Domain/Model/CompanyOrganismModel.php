<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

final class CompanyOrganismModel extends ValueObject implements MappingRequestInterface
{
    /**
     * @param string $provisioning
     * @param string $healthComplementary
     * @param string $pensionFund
     */
    public function __construct(
        private string $provisioning,
        private string $healthComplementary,
        private string $pensionFund
    ) {
    }

    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            $request->provisioning,
            $request->healthComplementary,
            $request->pensionFund,
        );
    }

    /**
     * @return string
     */
    public function provisioning(): string
    {
        return $this->provisioning;
    }

    /**
     * @return string
     */
    public function healthComplementary(): string
    {
        return $this->healthComplementary;
    }

    /**
     * @return string
     */
    public function pensionFund(): string
    {
        return $this->pensionFund;
    }
}
