<?php

namespace Sirhplus\Api\User\Application\Search;

use Sirhplus\Api\Salary\Application\Collections\SalaryResponse;
use Sirhplus\Api\User\Domain\Repository\SearchUserSalaryRepositoryInterface;
use Sirhplus\Shared\Application\SearchClient;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class SearchUserSalary
 */
final class SearchUserSalary implements SearchUserSalaryInterface
{
    /** @var array|string[] */
    private array $fields = ['lastName', 'firstName'];

    /**
     * @param SearchUserSalaryRepositoryInterface $repository
     */
    public function __construct(private readonly SearchUserSalaryRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $result = $this->repository->search(new SearchClient(
                'o',
                $this->fields,
                $request->getValues()
            )
        );

        return new SalaryResponse(
            $result->getData(),
            $result->getTotal(),
            0,
            0
        );
    }
}
