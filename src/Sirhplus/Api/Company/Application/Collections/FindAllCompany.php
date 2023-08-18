<?php

namespace Sirhplus\Api\Company\Application\Collections;

use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\ApplicationService;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindAllCompany
 */
final class FindAllCompany implements ApplicationService
{
    /**
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(private readonly CompanyRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return array|Response
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'company';
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

        return new CompaniesResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}
