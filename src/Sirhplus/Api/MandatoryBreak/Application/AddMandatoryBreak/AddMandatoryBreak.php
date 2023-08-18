<?php

namespace Sirhplus\Api\MandatoryBreak\Application\AddMandatoryBreak;

use Sirhplus\Api\MandatoryBreak\Domain\Model\AddMandatoryBreakModel;
use Sirhplus\Api\MandatoryBreak\Domain\Repository\MandatoryBreakRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class AddMandatoryBreak
 */
final class AddMandatoryBreak implements AddMandatoryBreakInterface
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
        $this->repository->add(AddMandatoryBreakModel::create($request));

        return null;
    }
}