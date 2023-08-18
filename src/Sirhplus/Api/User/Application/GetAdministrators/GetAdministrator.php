<?php

namespace Sirhplus\Api\User\Application\GetAdministrators;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Sirhplus\Shared\Service\RoleManagerInterface;

/**
 * class GetAdministrator
 */
final class GetAdministrator implements GetAdministratorInterface
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
            RoleManagerInterface::ROLE_ADMIN
        );

        return new GetAdministratorResponse($result);
    }
}
