<?php

namespace Sirhplus\Api\AbsencePlan\Application\CollectionAssignedSalaryAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\AssignAbsencePlanResultSet;
use Sirhplus\Api\AbsencePlan\Domain\Repository\AssignAbsencePlanRepositoryInterface;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllAssignedSalaryByAbsencePlan
 */
final class FindAllAssignedSalaryByAbsencePlan implements CollectionAssignedSalaryAbsencePlanInterface
{
    /**
     * @param AssignAbsencePlanRepositoryInterface $repository
     */
    public function __construct(private readonly AssignAbsencePlanRepositoryInterface $repository)
    {
    }
    
    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'absencePlan';
        $criteria = new Criteria(
            $request->getFilters(),
            $request->getSort(),
            $request->getPage(),
            $request->getSize(),
            $alias,
            ['companyUuid' => CompanyUuid::fromString($request->uuid)]

        );
        $select = new Select(
            $request->getFields(),
            $alias,
            true
        );

        $query = $this->repository->getMappingAssignAbsencePlan($select, $criteria);
        $resultSet = new AssignAbsencePlanResultSet($query->getObjects(), $query->getTotal());

        return new CollectionAssignedSalaryAbsencePlanResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}