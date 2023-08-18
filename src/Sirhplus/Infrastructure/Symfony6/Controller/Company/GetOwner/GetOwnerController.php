<?php

namespace Symfony6\Controller\Company\GetOwner;

use OpenApi\Annotations as OA;
use Sirhplus\Api\User\Application\GetOwner\GetOwnerInterface;
use Sirhplus\Api\User\Application\GetOwner\GetOwnerRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company/{uuid}/owners', name: 'get.owners.by.company', methods: ['GET'])]
final class GetOwnerController
{
    /**
     * Get all owner by company
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
     * @param GetOwnerInterface $service
     * @param GetOwnerRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        GetOwnerInterface $service,
        GetOwnerRequest $request
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
