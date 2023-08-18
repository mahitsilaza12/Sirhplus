<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\FindTeamManager;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\FindManager\FindTeamManagerInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\FindManager\FindTeamManagerRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony6\Controller\ApiController;

#[Route('/team/{uuid}/managers', name: 'find.team.managers', methods: ['GET'])]
final class FindTeamManagerController extends ApiController
{
    /**
     * Find team managers by uuid
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *              "data":{
     *                  {
     *                      "id":"string",
     *                      "firstName":"string",
     *                      "lastName":"string",
     *                      "logo":"string",
     *                      "responsibility":"string",
     *                      "email":"string",
     *                      "role":"array"
     *                  }
     *              },
     *              "meta":{
     *                  "total_page":"integer",
     *              }
     *         }
     *     )
     * )
     * @OA\Tag(name="Team")
     * @param string $uuid
     * @param FindTeamManagerInterface $service
     * @param FindTeamManagerRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        FindTeamManagerInterface $service,
        FindTeamManagerRequest $request
    ): JsonResponse {
        try {
            $request->setUuid($uuid);
            $this->validateRequest($request);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
