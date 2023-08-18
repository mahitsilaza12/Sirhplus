<?php

namespace Symfony6\Controller\HourlyRegime\ExtraHours;

use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\HourlyRegime\Application\ExtraHours\ExtraHoursInterface;
use Sirhplus\Api\HourlyRegime\Application\ExtraHours\ExtraHoursRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * class ExtraHours
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\HourlyRegime\Application\ExtraHours\ExtraHoursRequest")
 * @package Symfony6\Controller\HourlyRegime\ExtraHours
 */
#[Route('/hourly-regime/{uuid}/extra-hours', name: 'edit.hourlyRegime.extra.hours', methods: ['PATCH'])]
final class ExtraHoursController
{

     /**
     * Update extra hours in hourly regime by uuid
     * @OA\Response(
     *      response = "204",
     *      description = "No Content",
     *      @OA\JsonContent(
     *        @OA\Property( type = "string", property = "uuid", example = "string" ),
     *        @OA\Property( type = "bool", property = "accountAdditionalHour", example = "bool"),
     *        @OA\Property( type = "string", property = "frequency", example = "string")
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                "accountAdditionalHour": "bool",
     *                "frequency":"string"
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param ExtraHoursRequest $request
     * @param ExtraHoursInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, ExtraHoursRequest $request, ExtraHoursInterface $service): JsonResponse
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