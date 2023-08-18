<?php

namespace Symfony6\Controller\Company\GetAdministrator;

use OpenApi\Annotations as OA;
use Sirhplus\Api\User\Application\GetAdministrators\GetAdministratorInterface;
use Sirhplus\Api\User\Application\GetAdministrators\GetAdministratorRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company/{uuid}/administrators', name: 'get.administrators.by.company', methods: ['GET'])]
final class GetAdministratorController
{
    /**
     * Get all administrator by company
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
     *              }
     *         }
     *     )
     * )
     * @OA\Tag(name="Company")
     *
     * @param string $uuid
     * @param GetAdministratorInterface $service
     * @param GetAdministratorRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        GetAdministratorInterface $service,
        GetAdministratorRequest $request
    ): JsonResponse {
        try {
            $request->setUuid($uuid);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
