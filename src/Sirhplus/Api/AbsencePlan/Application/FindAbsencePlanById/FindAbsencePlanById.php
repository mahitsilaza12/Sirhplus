<?php

namespace Sirhplus\Api\AbsencePlan\Application\FindAbsencePlanById;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AbsencePlanRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAbsencePlanById
 */
final class FindAbsencePlanById implements FindAbsencePlanByIdInterface
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
        return new ShowAbsencePlanByIdResponse(
            $this->repository->findAbsencePlanById(AbsencePlanUuid::fromString($request->uuid))->object
        );
    }
}