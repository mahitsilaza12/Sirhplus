<?php

namespace Sirhplus\Api\DaylyConfig\Application\AddDayConfig;

use Sirhplus\Api\DaylyConfig\Domain\Model\AddDayConfigModel;
use Sirhplus\Api\DaylyConfig\Domain\Repository\DayConfigRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class AddDayConfig implements AddDayConfigInterface
{
    /**
     * @param DayConfigRepositoryInterface $repository
     */
    public function __construct(Private readonly DayConfigRepositoryInterface $repository)
    {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        return $this->repository->add(AddDayConfigModel::create($request));
    }
}