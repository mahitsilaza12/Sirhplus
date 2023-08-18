<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\FindSalaryByTeam;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Salary\Application\FindSalaryByTeam\FindSalaryByTeamInterface;
use Sirhplus\Api\Salary\Application\FindSalaryByTeam\FindSalaryByTeamRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/team/{uuid}/salaries', name: 'find.team.salaries', methods: ['GET'])]
final class FindSalaryByTeamController
{
    /**
     * Find salary by team uuid
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *              "data":{
     *                  {
     *                      "uuid":"string",
     *                      "firstName":"string",
     *                      "lastName":"string",
     *                      "picture":"string",
     *                  }
     *              },
     *              "meta" : {
     *                  "total_page": "integer"
     *              }
     *         }
     *     )
     * )
     * @OA\Tag(name="Team")
     * @param string $uuid
     * @param FindSalaryByTeamInterface $service
     * @param FindSalaryByTeamRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        FindSalaryByTeamInterface $service,
        FindSalaryByTeamRequest $request
    ): JsonResponse {
        try {
            $request->setUuid($uuid);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
