<?php

namespace Sirhplus\Api\User\Application\GetOwner;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Application\GetAdministrators\GetAdministratorResponse;
use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Sirhplus\Shared\Service\RoleManagerInterface;

/**
 * class GetOwner
 */
final class GetOwner implements GetOwnerInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->getUsersAdmin(
            CompanyUuid::fromString($request->getUuid()),
            RoleManagerInterface::ROLE_OWNER
        );

        return new GetAdministratorResponse($result);
    }
}
