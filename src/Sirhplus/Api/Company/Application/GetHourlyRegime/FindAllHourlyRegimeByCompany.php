<?php

namespace Sirhplus\Api\Company\Application\GetHourlyRegime;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllHourlyRegimeByCompany
 */
final class FindAllHourlyRegimeByCompany implements FindAllHourlyRegimeByCompanyInterface
{
    /**
     * @param HourlyRegimeRepositoryInterface $repository
     */
    public function __construct(private readonly HourlyRegimeRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->findHourlyRegimeByCompanyUuid(CompanyUuid::fromString($request->uuid));

        return new FindAllHourlyRegimeResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}