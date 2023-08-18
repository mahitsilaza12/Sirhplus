<?php

namespace Sirhplus\Api\HourlyRegime\Application\AddHourlyRegime;

use Sirhplus\Api\HourlyRegime\Domain\Model\AddHourlyRegimeModel;
use Sirhplus\Api\HourlyRegime\Domain\Repository\HourlyRegimeRepositoryInterface;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;


final class AddHourlyRegime implements AddHourlyRegimeInterface
{

    /**
     * @param HourlyRegimeRepositoryInterface $repository
     */
    public function __construct(
        private readonly HourlyRegimeRepositoryInterface $repository
    ) {
    }

    /**
     * @param Request $request
     * @return Response|null
     */
    public function execute(Request $request): ?Response
    {
       $result = $this->repository->add(AddHourlyRegimeModel::create($request));
        
        return new AddHourlyRegimeResponse($result->object);
    }
}