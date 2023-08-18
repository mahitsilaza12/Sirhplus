<?php

namespace Sirhplus\Api\Salary\Application\UpdatePicture;

use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Api\Salary\Domain\SalaryUuid;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class UpdatePicture
 */
final class UpdatePicture implements UpdatePictureInterface
{
    public function __construct(private readonly SalaryRepositoryInterface $repository)
    {
    }

    public function execute(Request $request): ?Response
    {
        $this->repository->updateLogo(SalaryUuid::fromString($request->companyUuid()), $request->logo);

        return null;
    }
}
