<?php

namespace Sirhplus\Api\HourlyRegime\Application\FindHourlyRegimeById;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class FIndHourlyRegime implements FindHourlyRegimeInterface
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
        return new ShowHourlyRegeimeByIdResponse(
            $this->repository->findHourlyRegimeById(HourlyRegimeUuid::fromString($request->uuid))->object
        );
    }
}