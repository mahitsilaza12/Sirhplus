<?php

namespace Sirhplus\Api\Salary\Application\AddSalary;

use Sirhplus\Api\Salary\Domain\Model\AddSalaryModel;
use Sirhplus\Api\Salary\Domain\Repository\SalaryRepositoryInterface;
use Sirhplus\Api\User\Application\Add\AddUserInterface;
use Sirhplus\Api\User\Application\Add\AddUserRequest;
use Sirhplus\Api\User\Application\Add\AddUserResponse;
use Sirhplus\Api\User\Domain\UserModel;
use Sirhplus\Shared\Service\Request;
use Sirhplus\Shared\Service\Response;

final class AddSalary implements AddSalaryInterface
{
    /**
     * @param SalaryRepositoryInterface $repository
     * @param AddUserInterface $userService
     */
    public function __construct(
        private readonly SalaryRepositoryInterface $repository,
        private readonly AddUserInterface $userService
    ) {
    }

    /**
     * @param Request $request
     * @return null|Response
     * @throws \Exception
     */
    public function execute(Request $request): ?Response
    {
        $user = $this->userService->add(UserModel::create(
            new AddUserRequest(
                $request->companyUuid,
                $request->email,
                $request->firstname,
                $request->lastname,
                $request->phone,
                $request->sex,
                $request->dateOfBirth,
            )
        ));

        $this->repository->add(AddSalaryModel::create($request), $user);

        return new AddUserResponse($user);
    }
}
