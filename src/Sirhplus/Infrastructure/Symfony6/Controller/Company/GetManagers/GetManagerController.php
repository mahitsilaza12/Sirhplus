<?php

namespace Symfony6\Controller\Company\GetManagers;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\GetManagers\GetManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;

#[Route('/company/{uuid}/managers', name: 'get.company-managers', methods: ['GET'])]
final class GetManagerController
{
    /**
     * Get all manager by company
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
     * @OA\Tag(name="Company")
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     *
     * @param string $uuid
     * @param GetManagerCollectionRequestData $request
     * @param GetManagerInterface $service
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        GetManagerCollectionRequestData $request,
        GetManagerInterface $service
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
