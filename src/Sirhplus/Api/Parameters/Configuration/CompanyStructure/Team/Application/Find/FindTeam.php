<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Find;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\TeamUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Infrastructure\Doctrine\TeamRepository;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class FindTeam implements FindTeamInterface
{
    /**
     * @param TeamRepository $repository
     */
    public function __construct(private readonly TeamRepository $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findByUuid(TeamUuid::fromString($request->uuid))->object;

        return new FindTeamResponse($result);
    }
}
