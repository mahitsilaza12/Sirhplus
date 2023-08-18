<?php

namespace Sirhplus\Api\Company\Application\UpdatePicture;

use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Company\Domain\Repository\CompanyRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class UpdatePicture
 */
final class UpdatePicture implements UpdatePictureInterface
{
    public function __construct(private readonly CompanyRepositoryInterface $repository)
    {
    }

    public function execute(Request $request): ?Response
    {
        $this->repository->updateLogo(CompanyUuid::fromString($request->companyUuid()), $request->logo);

        return null;
    }
}
