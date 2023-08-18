<?php

namespace Sirhplus\Api\Company\Application\GetTeams;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Domain\Repository\TeamRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllTeamsByCompany
 */
final class FindAllTeamsByCompany implements FindAllTeamsByCompanyInterface
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
        $result = $this->repository->findTeamByCompanyUuid(CompanyUuid::fromString($request->uuid));

        return new CompanyTeamResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}
