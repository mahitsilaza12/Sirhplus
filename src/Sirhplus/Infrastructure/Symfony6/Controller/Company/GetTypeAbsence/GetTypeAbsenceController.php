<?php

namespace Symfony6\Controller\Company\GetTypeAbsence;

use Sirhplus\Api\Company\Application\GetTypeAbsence\GetTypeAbsenceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

#[Route('/company/{uuid}/type-absence', name: 'get.type.by.company', methods: ['GET'])]
final class GetTypeAbsenceController
{
     /**
     * Get all type absence by company
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *              "data":{
     *                  {
     *                      "id":"string",
     *                      "type":"string"
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
     *
     * @param string $uuid
     * @param GetTypeAbsenceCollectionRequestData $request
     * @param GetTypeAbsenceInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, GetTypeAbsenceCollectionRequestData $request, GetTypeAbsenceInterface $service): JsonResponse
    {
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