<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Site\AssignSalary;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\AssignSalary\AssignSalaryInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\AssignSalary\AssignSalaryRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * class CreateSiteController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\AssignSalary\AssignSalaryRequest")
 * @package Symfony6\Controller\Parameters\Configuration\CompanyStructure\Site\AssignSalary
 */
#[Route('/site/{uuid}/assign-salary', name: 'site-assign.salary', methods: ['PATCH'])]
final class AssignSiteSalaryController
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
     * @OA\Tag(name="Site")
     *
     * @param string $uuid
     * @param AssignSalaryInterface $service
     * @param AssignSalaryRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, AssignSalaryInterface $service, AssignSalaryRequest $request): JsonResponse
    {
        try {
            $request->setSiteUuid($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
