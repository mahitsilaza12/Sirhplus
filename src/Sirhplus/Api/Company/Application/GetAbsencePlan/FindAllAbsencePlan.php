<?php

namespace Sirhplus\Api\Company\Application\GetAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\Repository\AbsencePlanRepositoryInterface;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllAbsencePlan
 */
final class FindAllAbsencePlan implements FindAllAbsencePlanInterface
{
    /**
     * @param AbsencePlanRepositoryInterface $repository
     */
    public function __construct(private readonly AbsencePlanRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findAbsencePlanByCompanyUuid(CompanyUuid::fromString($request->uuid));

        return new FindAllAbsencePlanResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}