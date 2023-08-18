<?php

namespace Sirhplus\Api\AbsencePlan\Application\RemoveAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AbsencePlanRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class RemoveAbsencePlan
 */
final class RemoveAbsencePlan implements RemoveAbsencePlanInterface
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
        return $this->repository->remove(AbsencePlanUuid::fromString($request->uuid));
    }
}