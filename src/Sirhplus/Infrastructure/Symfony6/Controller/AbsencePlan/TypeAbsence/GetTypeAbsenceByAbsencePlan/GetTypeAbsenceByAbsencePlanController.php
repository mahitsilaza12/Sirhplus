<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\GetTypeAbsenceByAbsencePlan;

use Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceByAbsencePlan\FindTypeAbsenceByAbsencePlanInterface;
use Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceByAbsencePlan\FindTypeAbsenceByAbsencePlanRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

#[Route('/absence-plan/{uuid}/absence-type/{absenceUuid}', name: 'find.absenceplan.typeabsence', methods: ['GET'])]
final class GetTypeAbsenceByAbsencePlanController
{
     /**
     * Find TypeAbsence by AbsencePlan uuid.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *    @OA\JsonContent(
     *         example={
     *              "uuid":"string",
     *              "typeRights":"string",
     *              "rights":"int",
     *              "accumulationPeriod":"string",
     *              "rightsRenewalDate":"string",
     *              "accumulationFrequency":"string",
     *              "consumptionPeriod":"string",
     *              "methodOfReduction":"string",
     *              "absence":"bool",
     *              "validation":"bool",
     *              "postponement":"string",
     *              "limitPerWeek":"bool",
     *              "activate":"bool",
     *              "absencePlanUuid":"string",
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Find TypeAbsence by Absenceplan uuid",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="TypeAbsence")
     * @Security(name="Bearer")
     * 
     * @param string $absenceUuid
     * @param string $uuid
     * @param FindTypeAbsenceByAbsencePlanRequest $request
     * @param FindTypeAbsenceByAbsencePlanInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $absenceUuid, string $uuid, FindTypeAbsenceByAbsencePlanRequest $request, FindTypeAbsenceByAbsencePlanInterface $service): JsonResponse
    {
        try{
            $request->setId($uuid);
            $request->setType($absenceUuid);
            $response =  $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Throwable $e)
        {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], $e->getCode() != 0 ? $e->getCode() : Response::HTTP_BAD_REQUEST);
        }        
    }
}