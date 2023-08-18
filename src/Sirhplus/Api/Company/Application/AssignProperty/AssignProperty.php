<?php

namespace Sirhplus\Api\Company\Application\AssignProperty;

use Sirhplus\Api\Company\Domain\CompanyNotFoundException;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Repository\AssignRepositoryInterface;
use Sirhplus\Api\User\Domain\UserNotFound;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class AssignProperty
 */
final class AssignProperty implements AssignPropertyInterface
{
    /**
     * @param AssignRepositoryInterface $repository
     */
    public function __construct(private readonly AssignRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     * @throws CompanyNotFoundException
     * @throws UserNotFound
     */
    public function execute(Request $request): ?Response
    {
        $this->repository->assignPropertyToCompany(
            CompanyUuid::fromString($request->uuid),
            UserUuid::fromString($request->userUuid)
        );

        return null;
    }
}
