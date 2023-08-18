<?php

namespace Sirhplus\Api\DaylyConfig\Application\FindAllDayConfig;

use Sirhplus\Api\DaylyConfig\Domain\Repository\DayConfigRepositoryInterface;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllDayConfig
 */
final class FindAllDayConfig implements FindAllDayConfigInterface
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
            $alias
        );
        $select = new Select(
            $request->getFields(),
            $alias,
            true
        );

        $resultSet = $this->repository->getMapping($select, $criteria);

        return new FindAllDayConfigResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}