<?php

namespace Sirhplus\Api\AbsencePlan\Application\AssignAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Shared\Domain\Doctrine\Repository\AssignSalaryRepositoryInterface;
use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\AbsencePlan;

final class AssignAbsencePlan implements AssignAbsencePlanInterface
{
    /**
     * @param AssignSalaryRepositoryInterface $repository
     */
    public function __construct(private readonly AssignSalaryRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        if (!$request->salaries) {
            throw new InvalidValueException();
        }
        
        $this->repository->assign(AbsencePlanUuid::fromString($request->getUuid()), $request->salaries, AbsencePlan::class);

        return null;
    }
}