<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\EditTypeAbsence;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\TypeAbsence\Application\EditTypeAbsence\EditTypeAbsenceInterface;
use Sirhplus\Api\TypeAbsence\Application\EditTypeAbsence\EditTypeAbsenceRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony6\Controller\ApiController;

/**
 * class EditTypeAbsenceController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\TypeAbsence\Application\EditTypeAbsence\EditTypeAbsenceRequest")
 * @package Symfony6\Controller\AbsencePlan\TypeAbsence\EditTypeAbsence
 */
#[Route('/absence-plan/{uuid}/absence-type/{absenceUuid}', name: 'edit.type.absence.plan', methods: ['PATCH'])]
final class EditTypeAbsenceController 
{

    /**
     * edit TypeAbsence by uuid absence plan
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *      @OA\JsonContent(
     *        @OA\Property( type = "string", property = "uuid", example = "string" ),
     *        @OA\Property( type = "string", property = "typeRights", example = "string"),
     *        @OA\Property( type = "integer", property = "rights", example = "int"),
     *        @OA\Property( type = "string", property = "accumulationPeriod", example = "string"),
     *        @OA\Property( type = "string", property = "rightsRenewalDate", example = "string"),
     *        @OA\Property( type = "string", property = "accumulationFrequency", example = "string"),
     *        @OA\Property( type = "string", property = "consumptionPeriod", example = "string"),
     *        @OA\Property( type = "string", property = "methodOfReduction", example = "string"),
     *        @OA\Property( type = "bool", property = "absence", example = "bool"),
     *        @OA\Property( type = "bool", property = "validation", example = "bool"),
     *        @OA\Property( type = "string", property = "postponement", example = "string"), 
     *        @OA\Property( type = "bool", property = "limitPerWeek", example = "bool"), 
     *        @OA\Property( type = "bool", property = "activate", example = "bool")
     *      )
     * ) 
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *           "typeRights":"String",
     *           "rights":"int",
     *           "accumulationPeriod":"String",
     *           "rightsRenewalDate":"String",
     *           "accumulationFrequency":"String",
     *           "consumptionPeriod":"String",
     *           "methodOfReduction":"String",
     *           "absence":"bool",
     *           "validation":"bool",
     *           "postponement":"String",
     *           "limitPerWeek":"bool",
     *           "restrictionLimitPerWeek":"string"
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Edit TypeAbsence",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="AbsencePlan")
     * 
     * @param string $uuid
     * @param EditTypeAbsenceRequest $request
     * @param EditTypeAbsenceInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, string $absenceUuid, EditTypeAbsenceRequest $request, EditTypeAbsenceInterface $service): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $request->setid($absenceUuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } 
    }
}