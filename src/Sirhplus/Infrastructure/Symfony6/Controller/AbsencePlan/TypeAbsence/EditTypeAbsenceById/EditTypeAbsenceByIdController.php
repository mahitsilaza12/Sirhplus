<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\EditTypeAbsenceById;

use Sirhplus\Api\TypeAbsence\Application\EditTypeAbsenceById\EditTypeAbsenceByIdInterface;
use Sirhplus\Api\TypeAbsence\Application\EditTypeAbsenceById\EditTypeAbsenceByIdRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * class EditTypeAbsenceByIdController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\TypeAbsence\Application\EditTypeAbsenceById\EditTypeAbsenceByIdRequest")
 * @package Symfony6\Controller\AbsencePlan\TypeAbsence\EditTypeAbsenceById
 */
#[Route('/absence-plan/absence-type/{Uuid}', name: 'edit.type.absence.plan.id', methods: ['PATCH'])]
final class EditTypeAbsenceByIdController
{

        /**
     * edit TypeAbsence by uuid
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *      @OA\JsonContent(
     *        @OA\Property( type = "string", property = "uuid", example = "string" ),
     *        @OA\Property( type = "string", property = "type", example = "string"),
     *        @OA\Property( type = "string", property = "color", example = "string"),
     *        @OA\Property( type = "bol", property = "visibility", example = "bool")
     *      )
     * ) 
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *           "type":"String",
     *           "color":"String",
     *           "visibility":"bool"
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Edit TypeAbsence",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="TypeAbsence")
     * 
     * 
     *
     * @param string $uuid
     * @param EditTypeAbsenceByIdRequest $request
     * @param EditTypeAbsenceByIdInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $Uuid, EditTypeAbsenceByIdRequest $request, EditTypeAbsenceByIdInterface $service): JsonResponse
    {
        try {
            $request->setUuid($Uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        } 
    }
}