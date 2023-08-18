<?php

namespace Symfony6\Controller\AbsencePlan\RemoveAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\RemoveAbsencePlan\RemoveAbsencePlanInterface;
use Sirhplus\Api\AbsencePlan\Application\RemoveAbsencePlan\RemoveAbsencePlanRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

#[Route('/absence-plan/{uuid}', name: 'delete.absence.plan', methods: ['DELETE'])]
final class RemoveAbsencePlanController
{
    /**
     * Remove absence-plan by uuid
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\Tag(name="AbsencePlan")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param RemoveAbsencePlanRequest $request
     * @param RemoveAbsencePlanInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, RemoveAbsencePlanRequest $request, RemoveAbsencePlanInterface $service): JsonResponse
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