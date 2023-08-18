<?php

namespace Sirhplus\Api\MandatoryBreak\Application\EditMandatoryBreak;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\MandatoryBreak\Domain\Model\EditMandatoryBreakModel;
use Sirhplus\Api\MandatoryBreak\Domain\Repository\MandatoryBreakRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

/**
 * class EditMandatoryBreak
 */
final class EditMandatoryBreak implements EditMandatoryBreakInterface
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
        $mandatory = $this->repository->findMandatoryBreakById(HourlyRegimeUuid::fromString($request->getId()))->object;

        return $this->repository->edit($mandatory, EditMandatoryBreakModel::create($request));
    }
}