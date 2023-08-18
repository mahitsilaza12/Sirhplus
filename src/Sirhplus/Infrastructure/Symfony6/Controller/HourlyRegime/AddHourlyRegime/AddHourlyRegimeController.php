<?php

namespace Symfony6\Controller\HourlyRegime\AddHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\AddHourlyRegime\AddHourlyRegimeInterface;
use Sirhplus\Api\HourlyRegime\Application\AddHourlyRegime\AddHourlyRegimeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony6\Controller\ApiController;


/**
 * class AddHourlyRegimeController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\HourlyRegime\Application\AddHourlyRegime\AddHourlyRegimeRequest")
 * @package Symfony6\Controller\HourlyRegime\AddHourlyRegime
 */
#[Route('/hourly-regime', name: 'add.hourlyRegime', methods: ['POST'])]
final class AddHourlyRegimeController extends ApiController
{

     /**
      * Add hourlyRegime
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *      @OA\JsonContent(
     *        @OA\Property( type = "string", property = "uuid", example = "string" ),
     *        @OA\Property( type = "string", property = "name", example = "string"),
     *        @OA\Property( type = "string", property = "companyId", example = 10)
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *      "additionalHour":{
     *                  "name":"String",
     *                  "companyId":"string",
     *                   }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="HourlyRegime",
     *     in="query",
     *     description="The field HourlyRegime",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * @param AddHourlyRegimeRequest $request
     * @param AddHourlyRegimeInterface $service
     * @return JsonResponse
     */
    public function __invoke(AddHourlyRegimeRequest $request, AddHourlyRegimeInterface $service): JsonResponse
    {
        try {
            $this->validateRequest($request);
            $data = $service->execute($request);

            return new JsonResponse($data->getContent(), Response::HTTP_CREATED);
        } catch(\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
