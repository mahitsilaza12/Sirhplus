<?php

namespace Sirhplus\Api\HourlyRegime\Application\AssignSalaryHourlyRegime;

use Sirhplus\Api\HourlyRegime\Domain\HourlyRegimeUuid;
use Sirhplus\Shared\Domain\Doctrine\Repository\AssignSalaryRepositoryInterface;
use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\HourlyRegime;

/**
 * class AssignSalaryHourlyRegime
 */
final class AssignSalaryHourlyRegime implements AssignSalaryHourlyRegimeInterface
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
        
        $this->repository->assign(HourlyRegimeUuid::fromString($request->getUuid()), $request->salaries, HourlyRegime::class);

        return null;
    }
}