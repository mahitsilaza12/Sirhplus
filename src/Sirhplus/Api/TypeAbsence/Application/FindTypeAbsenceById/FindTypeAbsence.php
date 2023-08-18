<?php

namespace Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceById;

use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindTypeAbsence
 */
final class FindTypeAbsence implements FindTypeAbsenceInterface
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
        return new ShowTypeAbsenceByIdResponse(
            $this->repository->findTypeAbsenceById(TypeAbsenceUuid::fromString($request->uuid))->object
        );
    }
}