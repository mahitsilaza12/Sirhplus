<?php

namespace Sirhplus\Api\Company\Application\UnassignedAdmin;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class UnassignedAdmin implements UnassignedAdminInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function execute(Request $request): ?Response
    {
        $usersUuid = array_map(function ($value) {
            return UserUuid::fromString($value);
        }, $request->administratorsUuid);

        $this->repository->unassigned(
            CompanyUuid::fromString($request->companyUuid),
            $usersUuid
        );

        return null;
    }
}
