<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\FindManager;

use Sirhplus\Api\Company\Application\GetUsersSalary\UserResponse;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\FindManagerRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

class FindTeamManager implements FindTeamManagerInterface
{
    public function __construct(private readonly FindManagerRepositoryInterface $repository)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findTeamManagers(TeamUuid::fromString($request->uuid));

        return new UserResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}
