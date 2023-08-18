<?php

namespace Sirhplus\Api\AbsencePlan\Application\EditAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\AbsencePlan\Domain\Model\EditAbsencePlanModel;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AbsencePlanRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class EditAbsencePlan
 */
final class EditAbsencePlan implements EditAbsencePlanInterface
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
        $absencePlan = $this->repository->findAbsencePlanById(AbsencePlanUuid::fromString($request->getUuid()))->object;
        $this->repository->edit($absencePlan, EditAbsencePlanModel::create($request));

        return null;
    }
}