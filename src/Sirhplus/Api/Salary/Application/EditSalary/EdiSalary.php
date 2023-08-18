<?php

namespace Sirhplus\Api\Salary\Application\EditSalary;

use Sirhplus\Api\Salary\Domain\Model\EditSalaryModel;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Api\Salary\Domain\SalaryUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class EdiSalary implements EditSalaryInterface
{
  /**
   *
   * @param SalaryRepositoryInterface $repository
   */
    public function __construct(private readonly SalaryRepositoryInterface $repository
    ) {
    }

    /**
     *
     * @param Request $request
     * @return Response|null
     * @throws \Exception
     */
    public function execute(Request $request): ?Response
    {
        $salary = $this->repository->findSalaryById(SalaryUuid::fromString($request->getId()))->object;
        $this->repository->edit($salary, EditSalaryModel::create($request));

        return null;
    }
}
