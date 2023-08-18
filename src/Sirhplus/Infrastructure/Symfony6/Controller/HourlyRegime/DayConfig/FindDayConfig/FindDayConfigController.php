<?php

namespace Symfony6\Controller\HourlyRegime\DayConfig\FindDayConfig;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sirhplus\Api\DaylyConfig\Application\FindDayConfigById\GetDayConfigInterface;

#[Route('/hourly-regime/{uuid}/day-config', name: 'find.hourlyRegime.dayConfig', methods: ['GET'])]
final class FindDayConfigController
{

    /**
     * Find DayConfig by Id.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * @OA\JsonContent(
     *         example={
     *          "data":{
     *                  "uuid":"String",
     *                  "type":"String",
     *                  "day":"String",
     *                  "startTime":"String",
     *                  "endTIme":"String",
     *                  "startBreakTime":"String",
     *                  "endBreakTime":"String",
     *                  "agreedWorkingHours":"String",
     *                  "status":"bool",
     *                  "hourlyRegimeUuid":"string"
     *          },
     *          "meta":{
     *                  "Total_page":"integer",
     *                 }
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     *
     */
    public function __invoke(string $uuid, FindDayConfigRequestData $request, GetDayConfigInterface $service): JsonResponse
    {

        try{
            $request->setUuid($uuid);
            $response =  $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch(\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], $e->getCode() != 0 ? $e->getCode() : Response::HTTP_BAD_REQUEST);
            
        }
    }
}