<?php

namespace Symfony6\Controller\Salary\Collections;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Salary\Application\Collections\FindAllSalaryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * class FindAllSalaryController
 */
#[Route('/company/{uuid}/salaries', name: 'find.salary.by.company', methods: ['GET'])]
final class FindAllSalaryController
{
    /**
     * Show all Salary by company uuid
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *   @OA\JsonContent(
     *         example={
     *      "data":{           
     *                  "id":"String",
     *                  "salary":"String",
     *                  "function":"String",
     *                  "team":"String",
     *                  "site":"String",
     *                  "email":"String",
     *                   },
     *      "meta":{
     *                  "Total_page":"integer",
     *                   }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Show all Salary",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Company")
     *
     * @param string $uuid
     * @param FindAllSalaryInterface $service
     * @param SalaryGetCollectionsRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        FindAllSalaryInterface $service,
        SalaryGetCollectionsRequestData $requestData
    ): JsonResponse {
        try {
            $requestData->setUuid($uuid);
            $response = $service->execute($requestData);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
