<?php

namespace Symfony6\Controller\Company\GetFunctions;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Company\Application\GetFunctions\FindAllFunctionByCompanyInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company/{uuid}/functions', name: 'get.company-functions', methods: ['GET'])]
final class GetFunctionsController
{
    /**
     * Get all function by company
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
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param GetFunctionCollectionRequestData $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        GetFunctionCollectionRequestData $request,
        FindAllFunctionByCompanyInterface $service
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
