<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\UnassignTypeAbsenceByAbsencePlan;

use Sirhplus\Api\TypeAbsence\Application\UnassignedAbsencePlanType\UnassignedAbsencePlanTypeInterface;
use Sirhplus\Api\TypeAbsence\Application\UnassignedAbsencePlanType\UnassignedAbsencePlanTypeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * class UnassignTypeAbsenceByAbsencePlanController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\TypeAbsence\Application\UnassignedAbsencePlanType\UnassignedAbsencePlanTypeRequest")
 * @package Symfony6\Controller\AbsencePlan\TypeAbsence\UnassignTypeAbsenceByAbsencePlan
 */
#[Route('/type-absence/{uuid}/unassign-absence-plan', name: 'type.absence.unassigned.absence.plan', methods: ['PUT'])]
final class UnassignTypeAbsenceByAbsencePlanController
{
    /**
     * Unassign type absence by Absence plan
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *      @OA\JsonContent(
     *        @OA\Property( type = "string", property = "uuid", example = "string" ),
     *        @OA\Property( type = "string", property = "companyId", example = "string")
     *      )
     * ) 
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *           "companyId":"String"
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="unassign type absence by Absence Type",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="TypeAbsence")
     * 
     *
     * @param string $uuid
     * @param UnassignedAbsencePlanTypeRequest $request
     * @param UnassignedAbsencePlanTypeInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, UnassignedAbsencePlanTypeRequest $request, UnassignedAbsencePlanTypeInterface $service): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_CREATED);
        } catch(\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }  
    }
}