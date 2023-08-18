<?php

namespace Sirhplus\Api\TypeAbsence\Application\EditTypeAbsence;

use Sirhplus\Api\AbsencePlan\Domain\AbsencePlanUuid;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AbsencePlanRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\Model\EditTypeAbsenceModel;
use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;


/**
 * class EditTypeAbsence
 */
final class EditTypeAbsence implements EditTypeAbsenceInterface
{

    /**
     * @param TypeAbsenceRepositoryInterface $repository
     */
    public function __construct(
        private readonly TypeAbsenceRepositoryInterface $repository,
        private readonly AbsencePlanRepositoryInterface $repo
        )
    {
    }

    public function execute(Request $request): ?Response
    {
        $typeAbsence = $this->repository->findTypeAbsenceById(TypeAbsenceUuid::fromString($request->absenceUuid))->object;
 
        $this->repository->edit($typeAbsence, EditTypeAbsenceModel::create($request));
        
        return null;
    }
}