<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\AddTypeAbsence;


use Sirhplus\Api\TypeAbsence\Application\AddTypeAbsence\AddTypeAbsenceInterface;
use Sirhplus\Api\TypeAbsence\Application\AddTypeAbsence\AddTypeAbsenceRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony6\Controller\ApiController;

/**
 * class AddTypeAbsenceController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\TypeAbsence\Application\AddTypeAbsence\AddTypeAbsenceRequest")
 * @package Symfony6\Controller\AbsencePlan\TypeAbsence\AddTypeAbsence
 */
#[Route('/absence-plan/absence-type', name: 'add.type.absence.plan', methods: ['POST'])]
final class AddTypeAbsenceController extends ApiController
{
 /**
     * Add Absence Type
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
     *           "visibility":"bool",
     *           "companyId":"string"
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Add Absence Type",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="TypeAbsence")
     * 
     * @param AddTypeAbsenceRequest $request
     * @param AddTypeAbsenceInterface $service
     * @return JsonResponse
     */
    public function __invoke(AddTypeAbsenceRequest $request, AddTypeAbsenceInterface $service): JsonResponse
    {
        try {
            $this->validateRequest($request);
            $response = $service->execute($request);
           
           return new JsonResponse($response->getContent(), Response::HTTP_CREATED);
       } catch (\Exception $e) {
           return new JsonResponse([
               'error' => $e->getMessage(),
           ], Response::HTTP_BAD_REQUEST);
       }        
    }
}