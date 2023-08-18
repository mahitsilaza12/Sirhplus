<?php

namespace Sirhplus\Api\Company\Application\GetSubscription;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class GetSubscription
 */
final class GetSubscription implements GetSubscriptionInterface
{
    /**
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(private readonly CompanyRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        return new GetSubscriptionResponse(
            $this->repository->findCompanyById(CompanyUuid::fromString($request->uuid))->object
        );
    }
}
