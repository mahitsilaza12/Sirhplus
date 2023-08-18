<?php

namespace Symfony6\Controller\Salary\FindSalaryById;

use Sirhplus\Api\Salary\Application\FindSalaryById\FindSalaryByIdRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Sirhplus\Api\Salary\Application\FindSalaryById\FindSalaryByIdInterface;

#[Route('/salary/{uuid}', name: 'find.salary', methods: ['GET'])]
final class FindSalaryByIdController
{
     /**
     * Find Salary by uuid.
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
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Find Salary by Id",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Salary")
     * @Security(name="Bearer")
     */
    public function __invoke(
        string $uuid,
        FindSalaryByIdRequest $request,
        FindSalaryByIdInterface $service
    ): JsonResponse {
        try{
            $request->setUuid($uuid);
            $response =  $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Throwable $e) {
            dd($e);
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], $e->getCode() != 0 ? $e->getCode() : Response::HTTP_BAD_REQUEST);
        }
    }
}
