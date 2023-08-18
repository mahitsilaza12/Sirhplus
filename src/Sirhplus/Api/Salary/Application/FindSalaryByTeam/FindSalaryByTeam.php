<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryByTeam;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Api\Salary\Application\Collections\SalaryResponse;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class FindSalaryByTeam implements FindSalaryByTeamInterface
{
    public function __construct(private readonly SalaryRepositoryInterface $repository)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findSalariesByType(TeamUuid::fromString($request->getUuid()), 'team');

        return new SalaryResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}
