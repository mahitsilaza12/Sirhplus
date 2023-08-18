<?php

namespace Sirhplus\Api\TypeAbsence\Application\EditTypeAbsenceById;

use Sirhplus\Api\TypeAbsence\Domain\Model\EditTypeAbsenceByIdModel;
use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class EditTypeAbsenceById
 */
final class EditTypeAbsenceById implements EditTypeAbsenceByIdInterface
{

    /**
     * @param TypeAbsenceRepositoryInterface $repository
     */
    public function __construct(private readonly TypeAbsenceRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $typeAbsence = $this->repository->findTypeAbsenceById(TypeAbsenceUuid::fromString($request->uuid))->object;

        return $data = $this->repository->editById($typeAbsence, EditTypeAbsenceByIdModel::create($request));
    }
}