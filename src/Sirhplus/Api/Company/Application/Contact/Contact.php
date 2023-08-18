<?php

namespace Sirhplus\Api\Company\Application\Contact;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\ContactResultSet;
use Sirhplus\Api\User\Domain\Repository\UserRepositoryInterface;
use Sirhplus\Shared\Application\Criteria;
use Sirhplus\Shared\Application\Select;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class Contact implements ContactInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function execute(Request $request): ?Response
    {
        $alias = 'user';
        $criteria = new Criteria(
            $request->getFilters(),
            $request->getSort(),
            $request->getPage(),
            $request->getSize(),
            $alias,
            ['companyUuid' => CompanyUuid::fromString($request->companyUuid)]
        );
        $select = new Select(
            $request->getFields(),
            $alias,
            true
        );

        $query = $this->repository->getMatching($select, $criteria);
        $result = new ContactResultSet($query->getObjects());

        return new ContactResponse($result->getData());
    }
}
