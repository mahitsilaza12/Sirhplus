<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\AssignTypeAbsenceByAbsenceplan;

use Sirhplus\Api\TypeAbsence\Application\AssignAbsencePlanType\AssignAbsencePlanTypeInterface;
use Sirhplus\Api\TypeAbsence\Application\AssignAbsencePlanType\AssignAbsencePlanTypeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
/**
 * class AssignTypeAbsenceByAbsenceplanController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\TypeAbsence\Application\AssignAbsencePlanType\AssignAbsencePlanTypeRequest")
 * @package Symfony6\Controller\AbsencePlan\TypeAbsence\AssignTypeAbsenceByAbsenceplan
 */
#[Route('/type-absence/{uuid}/assign-absence-plan', name: 'type.absence.assigned.absence.plan', methods: ['PUT'])]
final class AssignTypeAbsenceByAbsenceplanController
{
     /**
     * Assigne type absence by Absence plan
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
     *     description="assign type absence by Absence Type",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="TypeAbsence")
     * 
     *
     * @param string $uuid
     * @param AssignAbsencePlanTypeInterface $service
     * @param AssignAbsencePlanTypeRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, AssignAbsencePlanTypeInterface $service, AssignAbsencePlanTypeRequest $request): JsonResponse
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