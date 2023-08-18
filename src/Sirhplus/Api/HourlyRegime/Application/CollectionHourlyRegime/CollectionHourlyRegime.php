<?php

namespace Sirhplus\Api\HourlyRegime\Application\CollectionHourlyRegime;

use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class CollectionHourlyRegime
 */
final class CollectionHourlyRegime implements CollectionHourlyRegimeInterface
{
    /**
     * @param HourlyRegimeRepositoryInterface $repository
     */
    public function __construct(private readonly HourlyRegimeRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'Hourly';
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

        return new HourlyRegimeResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}