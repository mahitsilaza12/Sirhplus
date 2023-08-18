<?php

namespace Sirhplus\Api\Company\Application\GetManagers;

use Sirhplus\Api\Company\Application\GetUsersSalary\UserResponse;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class GetManager implements GetManagerInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->getUsersNotSupAdmin(CompanyUuid::fromString($request->uuid));

        return new UserResponse($result->getData(), $result->getTotal(), 0, 0);
    }
}
