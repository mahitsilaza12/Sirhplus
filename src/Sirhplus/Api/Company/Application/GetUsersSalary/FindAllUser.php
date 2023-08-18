<?php

namespace Sirhplus\Api\Company\Application\GetUsersSalary;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;
use Sirhplus\Api\User\Domain\UserResultSet;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class FindAllUser implements FindAllUserInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $alias = 'user';
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

        $query = $this->repository->getMatching($select, $criteria);
        $resultSet = new UserResultSet($query->getObjects(), $query->getTotal());

        return new UserResponse(
            $resultSet->getData(),
            $resultSet->getTotal(),
            $request->getPage(),
            $request->getSize()
        );
    }
}
