<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\FindTypeAbsence;

use Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceById\FindTypeAbsenceInterface;
use Sirhplus\Api\TypeAbsence\Application\FindTypeAbsenceById\FindTypeAbsenceRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

#[Route('/absence-plan/absence-type/{uuid}', name: 'find.typeabsence', methods: ['GET'])]
final class FindTypeAbsenceController 
{

    /**
     * Find TypeAbsence by uuid.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *    @OA\JsonContent(
     *         example={
     *              "uuid":"string",
     *              "type":"string",
     *              "color":"string",
     *              "visibility":"bool",
     *              "protected":"bool"
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Find TypeAbsence by uuid",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="TypeAbsence")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param FindTypeAbsenceRequest $request
     * @param FindTypeAbsenceInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindTypeAbsenceRequest $request, FindTypeAbsenceInterface $service): JsonResponse
    {
        try{
            $request->setId($uuid);
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