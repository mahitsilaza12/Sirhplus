<?php

namespace Sirhplus\Api\TypeAbsence\Application\RemoveTypeAbsence;

use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Api\TypeAbsence\Domain\TypeAbsenceUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class RemoveTypeAbsence
 */
final class RemoveTypeAbsence implements RemoveTypeAbsenceInterface
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
        return $this->repository->remove(TypeAbsenceUuid::fromString($request->uuid));
    }
}