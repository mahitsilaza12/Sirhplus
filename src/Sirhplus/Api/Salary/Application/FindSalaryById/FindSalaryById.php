<?php

namespace Sirhplus\Api\Salary\Application\FindSalaryById;

use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Api\Salary\Domain\SalaryUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class FindSalaryById implements FindSalaryByIdInterface
{
    /**
     * @param SalaryRepositoryInterface $repository
     */
    public function __construct(private readonly SalaryRepositoryInterface $repository)
    {
        
    }

    /**
     * @param Request $request
     * @return null|Response
     */
    public function execute(Request $request): ?Response
    {
       return new ShowSalaryByIdResponse(
            $this->repository->findSalaryById(SalaryUuid::fromString($request->uuid))->object
        );
    }
}
