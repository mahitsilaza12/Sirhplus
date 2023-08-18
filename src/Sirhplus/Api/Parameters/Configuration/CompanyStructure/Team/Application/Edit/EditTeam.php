<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Edit;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Model\EditTeamModel;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\TeamRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class EditTeam
 */
final class EditTeam implements EditTeamInterface
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
        $this->repository->edit(EditTeamModel::create($request));

        return null;
    }
}
