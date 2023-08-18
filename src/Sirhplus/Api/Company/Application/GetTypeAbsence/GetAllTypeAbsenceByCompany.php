<?php

namespace Sirhplus\Api\Company\Application\GetTypeAbsence;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class GetAllTypeAbsenceByCompany
 */
final class GetAllTypeAbsenceByCompany implements GetTypeAbsenceInterface
{
    /**
     * @param TypeAbsenceRepositoryInterface $repository
     */
    public function __construct(private readonly TypeAbsenceRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findTypeByCompany(CompanyUuid::fromString($request->uuid));

        return new GetTypeAbsenceResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}