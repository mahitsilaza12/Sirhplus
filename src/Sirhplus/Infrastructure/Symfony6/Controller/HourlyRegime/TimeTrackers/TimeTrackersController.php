<?php

namespace Symfony6\Controller\HourlyRegime\TimeTrackers;

use Sirhplus\Api\HourlyRegime\Application\TimeTrackers\TimeTrackersInterface;
use Sirhplus\Api\HourlyRegime\Application\TimeTrackers\TimeTrackersRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * class TimeTrackersController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\HourlyRegime\Application\TimeTrackers\TimeTrackersRequest")
 * @package Symfony6\Controller\HourlyRegime\TimeTrackers
 */
#[Route('/hourly-regime/{uuid}/time-trackers', name: 'edit.hourlyRegime.time.trackers', methods: ['PATCH'])]
final class TimeTrackersController
{
    /**
     * Update time tracker hourly regime by uuid
     * @OA\Response(
     *      response = "204",
     *      description = "No Content",
     *      @OA\JsonContent(
     *        @OA\Property( type = "string", property = "uuid", example = "string" ),
     *        @OA\Property( type = "bool", property = "calculation", example = "bool"),
     *        @OA\Property( type = "int", property = "dayCalculation", example = "int"),
     *        @OA\Property( type = "bool", property = "limite", example = "bool"),
     *        @OA\Property( type = "int", property = "limitDay", example = "int")
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  "calculation":"bool",
     *                  "dayCalculation":"int",
     *                  "limite":"bool",
     *                  "limitDay":"int"
     *                 }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param TimeTrackersRequest $request
     * @param TimeTrackersInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, TimeTrackersRequest $request, TimeTrackersInterface $service): JsonResponse
    {
        try {
            $request->setId($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch( \Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }        
    }
}