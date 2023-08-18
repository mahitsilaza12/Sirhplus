<?php

namespace Sirhplus\Api\DaylyConfig\Application\FindDayConfigById;

use Sirhplus\Api\DaylyConfig\Domain\DayConfigResultSet;
use Sirhplus\Api\DaylyConfig\Domain\DayConfigUuid;
use Sirhplus\Api\DaylyConfig\Domain\Repository\DayConfigRepositoryInterface;
use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindDayConfigById
 */
final class FindDayConfigById implements GetDayConfigInterface
{

    /**
     * @param DayConfigRepositoryInterface $repository
     */
    public function __construct(private readonly DayConfigRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'dayConfig';
        $criteria = new Criteria(
            $request->getFilters(),
            $request->getSort(),
            $request->getPage(),
            $request->getSize(),
            $alias,
            ['hourlyRegime' => HourlyRegimeUuid::fromString($request->uuid)]

        );
        $select = new Select(
            $request->getFields(),
            $alias,
            true
        );

        $query = $this->repository->getMappingDayConfig($select, $criteria);
        $resultSet = new DayConfigResultSet($query->getObjects(), $query->getTotal());

        return new FindDayConfigByIdResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}