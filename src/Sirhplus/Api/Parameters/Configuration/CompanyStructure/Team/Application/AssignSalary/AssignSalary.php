<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignSalary;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Shared\Domain\Doctrine\Repository\AssignSalaryRepositoryInterface;
use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\Team;

final class AssignSalary implements AssignSalaryInterface
{
    /**
     * @param AssignSalaryRepositoryInterface $repository
     */
    public function __construct(private readonly AssignSalaryRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        if (!$request->salaries) {
            throw new InvalidValueException();
        }
        $this->repository->assign(TeamUuid::fromString($request->teamUuid), $request->salaries, Team::class);

        return null;
    }
}
