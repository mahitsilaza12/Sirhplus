<?php

namespace Sirhplus\Api\TypeAbsence\Application\AddTypeAbsence;

use Sirhplus\Api\TypeAbsence\Domain\Model\AddTypeAbsenceModel;
use Sirhplus\Api\TypeAbsence\Domain\Repository\TypeAbsenceRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class AddTypeAbsence
 */
final class AddTypeAbsence implements AddTypeAbsenceInterface
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
        $result = $this->repository->add(AddTypeAbsenceModel::create($request));

        return new AddTypeAbsenceResponse($result->object);
    }
}