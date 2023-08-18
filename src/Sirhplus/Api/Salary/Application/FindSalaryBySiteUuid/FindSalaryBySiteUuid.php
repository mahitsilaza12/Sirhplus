<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryBySiteUuid;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Api\Salary\Application\Collections\SalaryResponse;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

class FindSalaryBySiteUuid implements FindSalaryBySiteUuidInterface
{
    public function __construct(private readonly SalaryRepositoryInterface $repository)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findSalariesByType(SiteUuid::fromString($request->getSiteUuid()), 'site');

        return new SalaryResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}
