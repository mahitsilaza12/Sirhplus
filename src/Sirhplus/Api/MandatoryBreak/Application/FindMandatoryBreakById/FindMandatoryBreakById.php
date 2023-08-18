<?php

namespace Sirhplus\Api\MandatoryBreak\Application\FindMandatoryBreakById;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\MandatoryBreak\Domain\Repository\MandatoryBreakRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class FindMandatoryBreakById
 */
final class FindMandatoryBreakById implements FindMandatoryBreakByIdInterface
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
        return new ShowMandatoryBreakByIdResponse(
            $this->repository->findMandatoryBreakById(HourlyRegimeUuid::fromString($request->uuid))->object
        );
    }
}