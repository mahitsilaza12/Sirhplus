<?php

namespace Sirhplus\Api\HourlyRegime\Application\EditHourlyRegime;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Api\HourlyRegime\Domain\Model\EditHourlyRegimeModel;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class EditHourlyRegime implements EditHourlyRegimeInterface
{

    /**
     * @param HourlyRegimeRepositoryInterface $repository
     */
    public function __construct(private readonly HourlyRegimeRepositoryInterface $repository) 
    {
    }
    
    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
        $hourlyRegime = $this->repository->findHourlyRegimeById(HourlyRegimeUuid::fromString($request->getId()))->object;

        return $this->repository->edit($hourlyRegime, EditHourlyRegimeModel::create($request));
    }
}