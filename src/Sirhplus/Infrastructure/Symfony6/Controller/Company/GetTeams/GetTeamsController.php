<?php

namespace Symfony6\Controller\Company\GetTeams;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\GetTeams\FindAllTeamsByCompanyInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company/{uuid}/teams', name: 'get.teams.by.company', methods: ['GET'])]
final class GetTeamsController
{
    /**
     * Get all team by company
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *              "data":{
     *                  {
     *                      "id":"string",
     *                      "name":"string",
     *                      "salary":"integer",
     *                  }
     *              },
     *              "meta":{
     *                  "total_page":"integer",
     *              }
     *         }
     *     )
     * )
     * @OA\Tag(name="Company")
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        GetTeamsCollectionRequestData $request,
        FindAllTeamsByCompanyInterface $service
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
