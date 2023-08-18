<?php

namespace Symfony6\Controller\HourlyRegime\CollectionHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\CollectionHourlyRegime\CollectionHourlyRegime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;


#[Route('/hourly-regimes', name: 'fetch.hourlyRegime', methods: ['GET'])]
final class FindAllHourlyRegimeController
{
    /**
     * Show all HourlyRegime
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *   @OA\JsonContent(
     *         example={
     *      "data":{           
     *                  "uuid":"String",
     *                  "name":"String",
     *                  "accountAdditionalHour":"bool",
     *                  "frequency":"String",
     *                  "limite":"bool",
     *                  "limitDay":"int",
     *                  "calculation":"bool",
     *                  "dayCalculation":"int",
     *                   },
     *      "meta":{
     *                  "Total_page":"int",
     *                   }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Show all HourlyRegime",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     *
     * @param CollectionHourlyRegime $service
     * @param HourlyGetCollectionsRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke(
        CollectionHourlyRegime $service,
        HourlyGetCollectionsRequestData $requestData
        ):JsonResponse {
        try {
           $response = $service->execute($requestData);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch(\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}