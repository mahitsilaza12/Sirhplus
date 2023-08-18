<?php

namespace Sirhplus\Api\HourlyRegime\Application\ExtraHours;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Model\ExtraHoursModel;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class ExtraHours
 */
final class ExtraHours implements ExtraHoursInterface
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
        $extraHours = $this->repository->findHourlyRegimeById(HourlyRegimeUuid::fromString($request->getId()))->object;

        return $this->repository->editExtraHours($extraHours, ExtraHoursModel::create($request));
    }
}