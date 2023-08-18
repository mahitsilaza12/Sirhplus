<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\Find;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Find\FindTeamInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Find\FindTeamRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony6\Controller\ApiController;

#[Route('/team/{uuid}', name: 'find.team', methods: ['GET'])]
final class FindTeamController extends ApiController
{
    /**
     * Find team by uuid
     * @OA\Response(
     *     response=200,
     *     description="Ok",
     * @OA\JsonContent(
     *         example={
     *             "id": "string",
     *             "name": "String",
     *         }
     *     )
     * )
     * @OA\Tag(name="Team")
     * @param string $uuid
     * @param FindTeamInterface $service
     * @param FindTeamRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindTeamInterface $service, FindTeamRequest $request): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $this->validateRequest($request);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
