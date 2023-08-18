<?php

namespace Sirhplus\Api\AbsencePlan\Application\CollectionAbsencePlan;

use Sirhplus\Api\AbsencePlan\Domain\Repository\AbsencePlanRepositoryInterface;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllAbsencePlan
 */
final class FindAllAbsencePlan implements CollectionAbsencePlanInterface
{
    /**
     * @param AbsencePlanRepositoryInterface $repository
     */
    public function __construct(private readonly AbsencePlanRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'AbsencePlan';
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

        $resultSet = $this->repository->getMatching($select, $criteria);

        return new CollectionAbsencePlanResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}