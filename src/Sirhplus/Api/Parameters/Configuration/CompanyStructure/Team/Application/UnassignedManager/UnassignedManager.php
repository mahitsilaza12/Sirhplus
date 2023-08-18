<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\UnassignedManager;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\UnassignedTeamRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class UnassignedManager implements UnassignedManagerInterface
{
    public function __construct(
        private readonly UnassignedTeamRepositoryInterface $repository,
        private readonly SalaryRepositoryInterface $salaryRepository
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(Request $request): ?Response
    {
        $salary = $this->salaryRepository->findSalaryByTeamUuid(
            TeamUuid::fromString($request->teamUuid),
            UserUuid::fromString($request->userUuid)
        );
        $this->repository->unassigned($salary);

        return null;
    }
}
