<?php

namespace Sirhplus\Api\AbsencePlan\Application\AddAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\Model\AddAbsencePlanModel;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AbsencePlanRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class AddAbsencePlan
 */
final class AddAbsencePlan implements AddAbsencePlanInterface
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
        $this->repository->add(AddAbsencePlanModel::create($request));

        return null;
    }
}