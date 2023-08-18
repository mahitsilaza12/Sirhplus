<?php

namespace Sirhplus\Api\Salary\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

/**
 * class SalaryModel
 */
final class SalaryModel extends ValueObject implements MappingRequestInterface
{
    /**
     * @param \DateTime $hiringDate
     */
    public function __construct(
        private readonly \DateTime $hiringDate,
    ) {
    }

    /**
     * @param Request $request
     * @return ValueObject
     * @throws \Exception
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            new \DateTime($request->hiringDate ?? 'now'),
        );
    }

    /**
     * @return \DateTime
     */
    public function hiringDate(): \DateTime
    {
        return $this->hiringDate;
    }
}
