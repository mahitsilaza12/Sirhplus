<?php

namespace Symfony6\Controller\HourlyRegime\MandatoryBreak\EditMandatoryBreak;

use Sirhplus\Api\MandatoryBreak\Application\EditMandatoryBreak\EditMandatoryBreakInterface;
use Sirhplus\Api\MandatoryBreak\Application\EditMandatoryBreak\EditMandatoryBreakRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony6\Controller\ApiController;


/**
 * class EditMandatoryBreakController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\MandatoryBreak\Application\EditMandatoryBreak\EditMandatoryBreakRequest")
 * @package Symfony6\Controller\HourlyRegime\MandatoryBreak\EditMandatoryBreak
 */
#[Route('/hourly-regime/{uuid}/mandatory-break/{id}', name: 'edit.mandatoryBreaks', methods: ['PATcH'])]
final class EditMandatoryBreakController extends ApiController
{

    /**
     * Update mandatory break by uuid 
     * @OA\Response(
     *      response = "204",
     *      description = "No Content",
     *      @OA\JsonContent(
     *        @OA\Property( type = "integer", property = "id", example = "1" ),
     *        @OA\Property( type = "string", property = "workingTimes", example = "00:00"),
     *        @OA\Property( type = "string", property = "pause", example = "00:00"),
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *        example={
     *                  "name":"String",
     *                  "workingTimes":"String",
     *                  "pause":"String"
     *                   }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * 
     *
     * @param string $uuid
     * @param string $id
     * @param EditMandatoryBreakRequest $request
     * @param EditMandatoryBreakInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid,string $id, EditMandatoryBreakRequest $request, EditMandatoryBreakInterface $service): JsonResponse
    {   
        try {
            $this->validateRequest($request);
            $request->setId($id);
            $request->sethourlyBreak($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch( \Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}