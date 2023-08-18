<?php

namespace Symfony6\Controller\HourlyRegime\EditHourlyRegime;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\HourlyRegime\Application\EditHourlyRegime\EditHourlyRegimeInterface;
use Sirhplus\Api\HourlyRegime\Application\EditHourlyRegime\EditHourlyRegimeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony6\Controller\ApiController;

/**
 * class EditHourlyRegimeController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\HourlyRegime\Application\EditHourlyRegime\EditHourlyRegimeRequest")
 * @package Symfony6\Controller\HourlyRegime\EditHourlyRegime
 */
#[Route('/hourly-regime/{uuid}', name: 'edit.hourlyRegime', methods: ['PATCH'])]
final class EditHourlyRegimeController extends ApiController
{

    /**
     * Update hourly regime by uuid
     * @OA\Response(
     *      response = "204",
     *      description = "No Content",
     *      @OA\JsonContent(
     *        @OA\Property( type = "string", property = "uuid", example = "string" ),
     *        @OA\Property( type = "string", property = "name", example = "string")
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *      "additionalHour":{
     *                  "name":"String"
     *                   }
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param EditHourlyRegimeRequest $request
     * @param EditHourlyRegimeInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, EditHourlyRegimeRequest $request, EditHourlyRegimeInterface $service): JsonResponse
    {
        try {
            $this->validateRequest($request);
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