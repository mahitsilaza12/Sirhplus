<?php

namespace Sirhplus\Api\Salary\Application\AddSalary;

use Sirhplus\Api\Salary\Domain\SalaryUuid;
use Sirhplus\Shared\Service\Response;

final class AddSalaryResponse implements Response
{
    public function __construct(private readonly SalaryUuid $uuid)
    {
    }

    public function getContent(): array
    {
        return [
            'uuid' => $this->uuid->toRfc4122(),
        ];
    }
}
