<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\RemoveTypeAbsence;

use Sirhplus\Api\TypeAbsence\Application\RemoveTypeAbsence\RemoveTypeAbsenceInterface;
use Sirhplus\Api\TypeAbsence\Application\RemoveTypeAbsence\RemoveTypeAbsenceRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

#[Route('/absence-plan/absence-type/{uuid}', name: 'remove.typeabsence', methods: ['DELETE'])]
final class RemoveTypeAbsenceController
{

     /**
     * Remove absence-type by uuid
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\Tag(name="TypeAbsence")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param RemoveTypeAbsenceRequest $request
     * @param RemoveTypeAbsenceInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, RemoveTypeAbsenceRequest $request, RemoveTypeAbsenceInterface $service): JsonResponse
    {
        try {
            $request->setId($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }        
    }
}