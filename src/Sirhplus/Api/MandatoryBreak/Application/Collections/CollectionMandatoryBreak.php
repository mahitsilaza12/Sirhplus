<?php

namespace Sirhplus\Api\MandatoryBreak\Application\Collections;

use Sirhplus\Api\MandatoryBreak\Domain\Repository\MandatoryBreakRepositoryInterface;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class CollectionMandatoryBreak
 */
final class CollectionMandatoryBreak implements CollectionMandatoryBreakInterface
{
    /**
     * @param MandatoryBreakRepositoryInterface $repository
     */
    public function __construct(private readonly MandatoryBreakRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'MandatoryBreak';
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

        return new MandatoryBreakResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}