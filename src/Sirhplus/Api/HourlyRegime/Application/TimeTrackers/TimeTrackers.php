<?php

namespace Sirhplus\Api\HourlyRegime\Application\TimeTrackers;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Model\TimeTrackersModel;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class TimeTrackers
 */
final class TimeTrackers implements TimeTrackersInterface
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
        $timeTrackers = $this->repository->findHourlyRegimeById(HourlyRegimeUuid::fromString($request->getId()))->object;

        return $this->repository->editTimeTrackers($timeTrackers, TimeTrackersModel::create($request));
    }
}