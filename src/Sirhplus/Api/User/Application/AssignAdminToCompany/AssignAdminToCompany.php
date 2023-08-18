<?php

namespace Sirhplus\Api\User\Application\AssignAdminToCompany;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Domain\Repository\AssignRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class AssignAdmin
 */
final class AssignAdminToCompany implements AssignAdminToCompanyInterface
{
    /**
     * @param AssignRepositoryInterface $repository
     */
    public function __construct(private readonly AssignRepositoryInterface $repository)
    {
    }

    public function execute(Request $request): ?Response
    {
        // TODO: Implement execute() method.
        $this->repository->assignAdminToCompany(CompanyUuid::fromString($request->uuid), $request->users);

        return null;
    }
}
