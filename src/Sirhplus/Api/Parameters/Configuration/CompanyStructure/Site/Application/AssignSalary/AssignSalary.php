<?php

namespace Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\AssignSalary;

use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Domain\SiteUuid;
use Sirhplus\Shared\Domain\Doctrine\Repository\AssignSalaryRepositoryInterface;
use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\Site;

/**
 * class AssignSalary
 */
final class AssignSalary implements AssignSalaryInterface
{
    /**
     * @param AssignSalaryRepositoryInterface $repository
     */
    public function __construct(private readonly AssignSalaryRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        if (!$request->salaries) {
            throw new InvalidValueException();
        }

        $this->repository->assign(SiteUuid::fromString($request->siteUuid), $request->salaries, Site::class);

        return null;
    }
}
