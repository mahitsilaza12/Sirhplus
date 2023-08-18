<?php

namespace Sirhplus\Api\Company\Application\UnassignedProperty;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Api\User\Domain\UserUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class UnassignedProperty implements UnassignedPropertyInterface
{
    public function __construct(private readonly CompanyRepositoryInterface $repository)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(Request $request): ?Response
    {
        $this->repository->unassignedProperty(
            CompanyUuid::fromString($request->companyUuid),
            UserUuid::fromString($request->userUuid)
        );

        return null;
    }
}
