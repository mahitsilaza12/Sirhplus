<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\AssignSalary;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignSalary\AssignSalaryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignSalary\AssignSalaryRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * class CreateSiteController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignSalary\AssignSalaryRequest")
 * @package Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\AssignSalary
 */
#[Route('/team/{uuid}/assign-salary', name: 'team.assign.salary', methods: ['PATCH'])]
final class AssignTeamSalaryController
{
    /**
     * Assign salary
     *
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *              "salaries":"array",
     *         }
     *     )
     * )
     * @OA\Tag(name="Team")
     *
     * @param string $uuid
     * @param AssignSalaryInterface $service
     * @param AssignSalaryRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, AssignSalaryInterface $service, AssignSalaryRequest $request): JsonResponse
    {
        try {
            $request->setTeamUuid($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
