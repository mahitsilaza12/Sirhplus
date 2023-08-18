<?php

namespace Sirhplus\Api\HourlyRegime\Application\FindTimeTrackersById;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindTimeTrackersById
 */
final class FindTimeTrackersById implements FindTimeTrackersByIdInterface
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
        return new ShowFindTimeTrackersByIdResponse(
            $this->repository->findHourlyRegimeById(HourlyRegimeUuid::fromString($request->uuid))->object
        );
    }
}