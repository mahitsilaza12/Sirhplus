<?php

namespace Sirhplus\Api\MandatoryBreak\Application\RemoveMandatoryBreak;

use Sirhplus\Api\MandatoryBreak\Domain\Repository\MandatoryBreakRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class RemoveMandatoryBreak
 */
final class RemoveMandatoryBreak implements RemoveMandatoryBreakInterface
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
        return $this->repository->remove($request->uuid);
    }
}