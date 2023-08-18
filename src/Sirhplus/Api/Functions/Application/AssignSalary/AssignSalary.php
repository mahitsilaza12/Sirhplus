<?php

namespace Sirhplus\Api\Functions\Application\AssignSalary;

use Sirhplus\Api\Functions\Domain\FunctionUuid;
use Sirhplus\Shared\Domain\Doctrine\Repository\AssignSalaryRepositoryInterface;
use Sirhplus\Shared\Domain\Exception\InvalidValueException;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;
use Symfony6\Entity\Functions;

/**
 * class AssignSalary
 */
final class AssignSalary implements AssignSalaryInterface
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
     * @throws InvalidValueException
     */
    public function execute(Request $request): ?Response
    {
        if (!$request->salaries) {
            throw new InvalidValueException();
        }

        $this->repository->assign(FunctionUuid::fromString($request->uuid), $request->salaries, Functions::class);

        return null;
    }
}
