<?php

namespace Symfony6\Controller\Salary\FindSalaryByFunction;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Salary\Application\FindSalaryByFunction\FindSalaryByFunctionInterface;
use Sirhplus\Api\Salary\Application\FindSalaryByFunction\FindSalaryByFunctionRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/function/{uuid}/salaries', name: 'find.salaries.by.function', methods: ['GET'])]
final class FindSalaryByFunctionController
{
    /**
     * Find Salaries by function uuid.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * @OA\JsonContent(
     *         example={
     *        "salary":{
     *                  "firstName": "String",
     *                  "lastName": "String",
     *                  "email": "String",
     *                  "hiringDate":{
     *                              "date":"y-m-d",
     *                              "timezone_type":"String",
     *                              "timezone":"String"
     *                              },
     *                  "status": "String",
     *                  "sexe": "String",
     *                  "dateOfBirth":{
     *                              "date":"y-m-d",
     *                              "timezone_type":"String",
     *                              "timezone":"String"
     *                              },
     *
     *                 },
     *        "site":{
     *                  "siteId": "String",
     *                  "name": "String",
     *                 },
     *        "absencePlan":{
     *                  "absencePlanId": "String",
     *                  "name": "String",
     *                 },
     *        "crew":{
     *                  "crewId": "String",
     *                  "name": "String",
     *                 },
     *        "functions":{
     *                  "functionId": "String",
     *                  "name": "String",
     *                 },
     *        "hourlyRegime":{
     *                  "hourlyRegimeId": "String",
     *                  "name": "String",
     *                 }
     *         }
     *     )
     * )
     * @OA\Tag(name="Functions")
     * @param string $uuid
     * @param FindSalaryByFunctionInterface $service
     * @param FindSalaryByFunctionRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        FindSalaryByFunctionInterface $service,
        FindSalaryByFunctionRequest $request
    ): JsonResponse {
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
