<?php

namespace Symfony6\Controller\Salary\FindSalaryByHourlyRegime;

use Sirhplus\Api\Salary\Application\FindSalaryByHourlyRegime\FindSalaryByHourlyRegimeInterface;
use Sirhplus\Api\Salary\Application\FindSalaryByHourlyRegime\FindSalaryByHourlyRegimeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

#[Route('/hourly-regime/{uuid}/assigned-salaries', name: 'hourly.assigned.salaries', methods: ['GET'])]
final class FindSalaryByHourlyRegimeController
{

    /**
     * Show all salary assigned to hourly regime
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
     *     description="Show all AbsencePlan",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param FindSalaryByHourlyRegimeRequest $request
     * @param FindSalaryByHourlyRegimeInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindSalaryByHourlyRegimeRequest $request, FindSalaryByHourlyRegimeInterface $service): JsonResponse
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