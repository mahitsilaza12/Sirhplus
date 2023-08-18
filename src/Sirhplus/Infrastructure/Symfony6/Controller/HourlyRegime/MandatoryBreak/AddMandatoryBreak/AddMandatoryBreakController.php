<?php

namespace Symfony6\Controller\HourlyRegime\MandatoryBreak\AddMandatoryBreak;

use Sirhplus\Api\MandatoryBreak\Application\AddMandatoryBreak\AddMandatoryBreakInterface;
use Sirhplus\Api\MandatoryBreak\Application\AddMandatoryBreak\AddMandatoryBreakRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony6\Controller\ApiController;

/**
 * class AddMandatoryBreakController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\MandatoryBreak\Application\AddMandatoryBreak\AddMandatoryBreakRequest")
 * @package Symfony6\Controller\HourlyRegime\MandatoryBreak\AddMandatoryBreak
 */
#[Route('/hourly-regime/{uuid}/mandatory-break', name: 'add.mandatoryBreaks', methods: ['POST'])]
final class AddMandatoryBreakController extends ApiController
{
   
    /**
     * Add mandatory by hourly regime uuid
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *      @OA\JsonContent(
     *        @OA\Property( type = "integer", property = "id", example = "1" ),
     *        @OA\Property( type = "string", property = "workingTimes", example = "00:00"),
     *        @OA\Property( type = "string", property = "pause", example = "00:00"),
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  "name":"String",
     *                  "workingTimes":"String",
     *                  "pause":"String"
     *                   }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param AddMandatoryBreakRequest $request
     * @param AddMandatoryBreakInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid , AddMandatoryBreakRequest $request, AddMandatoryBreakInterface $service): JsonResponse
    {
        try {
            $this->validateRequest($request);
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