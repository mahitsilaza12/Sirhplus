<?php

namespace Sirhplus\Api\Salary\Application\Collections;

use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\GetCurrentUserInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 *
 */
final class FindAllSalary implements FindAllSalaryInterface
{
    /**
     * @param SalaryRepositoryInterface $repository
     * @param GetCurrentUserInterface $currentUser
     */
    public function __construct(
        private readonly SalaryRepositoryInterface $repository,
        private readonly GetCurrentUserInterface $currentUser
    ) {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'salary';
        $criteria = new Criteria(
            $request->getFilters(),
            $request->getSort(),
            $request->getPage(),
            $request->getSize(),
            $alias,
            ['user' => $this->currentUser->getCurrentUser()]
        );
        $select = new Select(
            $request->getFields(),
            $alias,
            true
        );

        $resultSet = $this->repository->getMatching($select, $criteria);

        return new SalaryResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}
