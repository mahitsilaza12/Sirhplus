<?php

namespace Sirhplus\Api\HourlyRegime\Application\RemoveHourlyRegime;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class RemoveHourlyRegime
 */
final class RemoveHourlyRegime implements RemoveHourlyRegimeInterface
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
        return $this->repository->remove(HourlyRegimeUuid::fromString($request->uuid));
    }
}