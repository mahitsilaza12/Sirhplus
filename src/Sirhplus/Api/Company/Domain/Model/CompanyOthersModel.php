<?php

namespace Sirhplus\Api\Company\Domain\Model;

use Sirhplus\Shared\Domain\ValueObject\ValueObject;
use Sirhplus\Shared\Service\MappingRequestInterface;
use Sirhplus\Shared\Service\Request;

class CompanyOthersModel extends ValueObject implements MappingRequestInterface
{
    /**
     * @param string $schedule
     * @param string $leadingStatus
     * @param string $assignment
     */
    public function __construct(
        public string $schedule = '',
        public string $leadingStatus = '',
        public string $assignment = ''
    ) {
    }

    /**
     * @param Request $request
     * @return ValueObject
     */
    public static function create(Request $request): ValueObject
    {
        return new self(
            $request->schedule,
            $request->leadingStatus,
            $request->assignment,
        );
    }

    /**
     * @return string
     */
    public function schedule(): string
    {
        return $this->schedule;
    }

    /**
     * @return string
     */
    public function leadingStatus(): string
    {
        return $this->leadingStatus;
    }

    /**
     * @return string
     */
    public function assignment(): string
    {
        return $this->assignment;
    }
}
