<?php

namespace Symfony6\Controller\Salary\FindSalaryByAbsencePlan;

use Sirhplus\Api\Salary\Application\FindSalaryByAbsencePlan\FindSalaryByAbsencePlanInterface;
use Sirhplus\Api\Salary\Application\FindSalaryByAbsencePlan\FindSalaryByAbsencePlanRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * class FindSalaryByAbsencePlanController
 */
#[Route('/absence-plan/{uuid}/salaries', name: 'absence.assigned.salaries', methods: ['GET'])]
final class FindSalaryByAbsencePlanController
{

    /**
     * Show all salary assigned AbsencePlan by companyId
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *      "data":{           
     *                  "salary":{
     *                          "uuid":"string",
     *                          "logo":"string",
     *                          "firstName":"string",
     *                          "lastName":"string"
     *                      }
     *             },
     *      "meta":{
     *                  "Total_page":"integer",
     *                   }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Show all salary assign absence plan by Company uuid",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="AbsencePlan")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param FindSalaryByAbsencePlanRequest $request
     * @param FindSalaryByAbsencePlanInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindSalaryByAbsencePlanRequest $request, FindSalaryByAbsencePlanInterface $service): JsonResponse
    {
        try{
            $request->setUuid($uuid);
            $response =  $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}