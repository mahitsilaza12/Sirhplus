<?php

namespace Symfony6\Controller\Company\GetHourlyRegime;

use Sirhplus\Api\Company\Application\GetHourlyRegime\FindAllHourlyRegimeByCompanyInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;


#[Route('/company/{uuid}/hourly-regime', name: 'get.hourly.regime.by.company', methods: ['GET'])]
final class GetHourlyRegimeController
{
    /**
     * Get all hourly regime by company
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
     * @param GetHourlyRegimeRequestData $requestData
     * @param FindAllHourlyRegimeByCompanyInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, GetHourlyRegimeRequestData $requestData, FindAllHourlyRegimeByCompanyInterface $service): JsonResponse
    {
        try {
            $requestData->setUuid($uuid);
            $response = $service->execute($requestData);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }        
    }
}