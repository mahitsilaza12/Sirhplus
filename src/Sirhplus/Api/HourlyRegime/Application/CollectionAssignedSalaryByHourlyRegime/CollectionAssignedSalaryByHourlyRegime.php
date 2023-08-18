<?php

namespace Sirhplus\Api\HourlyRegime\Application\CollectionAssignedSalaryByHourlyRegime;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\HourlyRegime\Domain\CollectionAssigneeHourlyRegimeResultSet;
use Sirhplus\Api\HourlyRegime\Domain\Repository\AssignSalaryHourlyRepositoryInterface;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class CollectionAssignedSalaryByHourlyRegime
 */
final class CollectionAssignedSalaryByHourlyRegime implements CollectionAssignedSalaryByHourlyRegimeInterface
{
    /**
     * @param AssignSalaryHourlyRepositoryInterface $repository
     */
    public function __construct(private readonly AssignSalaryHourlyRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'hourlyRegime';
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

        $query = $this->repository->getMappingAssign($select, $criteria);
        $resultSet = new CollectionAssigneeHourlyRegimeResultSet($query->getObjects(), $query->getTotal());

        return new CollectionAssignedSalaryByHourlyRegimeResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}