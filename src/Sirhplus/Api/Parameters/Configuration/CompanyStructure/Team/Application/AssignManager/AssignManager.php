<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignManager;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\AssignTeamManagerInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Shared\Domain\Doctrine\Repository\AssignSalaryRepositoryInterface;
use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\Team;

final class AssignManager implements AssignManagerInterface
{
    public function __construct(
        private readonly AssignSalaryRepositoryInterface $repository,
        private readonly AssignTeamManagerInterface $manager
    ) {
    }

    public function execute(Request $request): ?Response
    {
        if (!$request->users) {
            throw new InvalidValueException();
        }
        $this->repository->assign(TeamUuid::fromString($request->teamUuid), $request->users, Team::class);
        $this->manager->assign($request->users);

        return null;
    }
}
