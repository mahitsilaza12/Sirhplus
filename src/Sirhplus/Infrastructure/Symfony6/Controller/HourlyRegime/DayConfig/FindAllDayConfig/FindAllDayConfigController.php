<?php

namespace Symfony6\Controller\HourlyRegime\DayConfig\FindAllDayConfig;

use Sirhplus\Api\DaylyConfig\Application\FindAllDayConfig\FindAllDayConfigInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hourly-regime/day-config', name: 'fetch.hourlyRegime.dayConfig', methods: ['GET'])]
final class FindAllDayConfigController
{
    /**
     * FindAll DayConfig.
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
     * @param FindAllDayConfigRequestData $request
     * @param FindAllDayConfigInterface $service
     * @return JsonResponse
     */
    public function __invoke(FindAllDayConfigRequestData $request, FindAllDayConfigInterface $service): JsonResponse
    {
        try {
            $response = $service->execute($request);
 
             return new JsonResponse($response->getContent(), Response::HTTP_OK);
         } catch(\Exception $e) {
             return new JsonResponse([
                 'error' => $e->getMessage(),
             ],Response::HTTP_BAD_REQUEST);
         }
    }
}