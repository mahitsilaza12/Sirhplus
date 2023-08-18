<?php

namespace Sirhplus\Api\HourlyRegime\Application\UnassignedSalaryHourlyRegime;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Repository\AssignSalaryHourlyRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\HourlyRegime;

/**
 * class UnAssignedSalaryHourlyRegime
 */
final class UnAssignedSalaryHourlyRegime implements UnassignedSalaryHourlyRegimeInterface
{
    /**
     * @param AssignSalaryHourlyRepositoryInterface $repository
     */
    public function __construct(private readonly AssignSalaryHourlyRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $this->repository->UnAssignSalaryHourlyRegime(HourlyRegimeUuid::fromString($request->getUuid()), $request->users, HourlyRegime::class);
    
        return null;
    }
}