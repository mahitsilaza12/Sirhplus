<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Site\FindSalaryBySiteUuid;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Salary\Application\FindSalaryBySiteUuid\FindSalaryBySiteUuidInterface;
use Sirhplus\Api\Salary\Application\FindSalaryBySiteUuid\FindSalaryBySiteUuidRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/site/{uuid}/salaries', name: 'find.salary.by.site.uuid', methods: ['GET'])]
final class FindSalaryBySiteUuidController
{
    /**
     * Find Salary by site uuid
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *   @OA\JsonContent(
     *         example={
     *              "data":{
     *                  "uuid":"String",
     *                  "firstname":"String",
     *                  "lastname":"String",
     *                   },
     *              "meta":{
     *                  "total_page":"integer",
     *              }
     *         }
     *     )
     * )
     * @OA\Tag(name="Site")
     */
    public function __invoke(
        string $uuid,
        FindSalaryBySiteUuidInterface $service,
        FindSalaryBySiteUuidRequest $request
    ): JsonResponse {
        try {
            $request->setSiteUuid($uuid);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
                'code' => Response::HTTP_BAD_REQUEST,
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
