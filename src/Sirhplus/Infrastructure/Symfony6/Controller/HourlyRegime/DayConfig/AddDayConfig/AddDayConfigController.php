<?php

namespace Symfony6\Controller\HourlyRegime\DayConfig\AddDayConfig;

use DateTime;
use Sirhplus\Api\DaylyConfig\Application\AddDayConfig\AddDayConfigInterface;
use Sirhplus\Api\DaylyConfig\Application\AddDayConfig\AddDayConfigRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;


/**
 * class AddDayConfigController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\DaylyConfig\Application\AddDayConfig\AddDayConfigRequest")
 * @package Symfony6\Controller\HourlyRegime\DayConfig\AddDayConfig
 */
#[Route('/hourly-regime/{uuid}/day-config', name: 'add.hourlyRegime.dayConfig', methods: ['POST'])]
final class AddDayConfigController
{

     /** 
     * add and update dayConfig by hourly regime
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *              "dayConfig":{
     *              {
     *                  "day": "string",
     *                  "startTime": "string",
     *                  "endTIme": "string",
     *                  "startBreakTime": "string", 
     *                  "endBreakTime": "string" ,
     *                  "agreedWorkingHours": "string" ,
     *                  "type": "string" ,
     *                  "status": "boolean"
     *              }
     * },
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="HourlyRegime",
     *     in="query",
     *     description="The field DayConfig",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * @param integer $uuid
     * @param AddDayConfigRequest $request
     * @param AddDayConfigInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid,AddDayConfigRequest $request, AddDayConfigInterface $service) :JsonResponse
    {
        try {
            $timestart = new DateTime($request->dayConfig[0]['startTime']);
            $timeend = new DateTime($request->dayConfig[0]['endTIme']);
            $startBreakTime = new DateTime($request->dayConfig[0]['startBreakTime']);
            $endBreakTime = new DateTime($request->dayConfig[0]['endBreakTime']);
            $timeWork = $timestart > $timeend;
            $breakTime = $startBreakTime > $endBreakTime;
            if($timeWork) {
                return new JsonResponse([
                    'error' => "timeStart is lower than timeEnd"
                ]);
            }
            if($breakTime) {
                return new JsonResponse([
                    'error' => "startBreakTime is lower than endBreakTime"
                ]);
            }
            $request->sethourlyBreak($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_CREATED);
        } catch(\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}