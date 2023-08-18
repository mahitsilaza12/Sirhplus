<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Remove;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\TeamRepositoryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class RemoveTeam
 */
final class RemoveTeam implements RemoveTeamInterface
{
    /**
     * @param TeamRepositoryInterface $repository
     */
    public function __construct(private readonly TeamRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $this->repository->remove(TeamUuid::fromString($request->uuid));

        return null;
    }
}
