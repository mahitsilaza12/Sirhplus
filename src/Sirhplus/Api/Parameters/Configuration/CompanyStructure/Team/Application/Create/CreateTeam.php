<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Create;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model\CreateTeamModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\TeamRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class CreateTeam
 */
final class CreateTeam implements CreateTeamInterface
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
        $this->repository->create(CreateTeamModel::create($request));

        return null;
    }
}
