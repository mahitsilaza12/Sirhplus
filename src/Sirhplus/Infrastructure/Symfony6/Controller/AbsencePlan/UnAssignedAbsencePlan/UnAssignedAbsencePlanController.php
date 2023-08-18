<?php

namespace Symfony6\Controller\AbsencePlan\UnAssignedAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\UnAssignedAbsencePlan\UnAssignedAbsencePlanInterface;
use Sirhplus\Api\AbsencePlan\Application\UnAssignedAbsencePlan\UnAssignedAbsencePlanRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * class UnAssignedAbsencePlanController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\AbsencePlan\Application\UnAssignedAbsencePlan\UnAssignedAbsencePlanRequest")
 * @package Symfony6\Controller\AbsencePlan\UnAssignedAbsencePlan
 */
#[Route('/absence-plan/{uuid}/unassigned-salary', name: 'absence.unassigned.salary', methods: ['PUT'])]
final class UnAssignedAbsencePlanController
{
     /**
     * Unassigned AbsencePlan to salary by companyUuid
     * @OA\Response(
     *     response=200,
     *     description="Ok"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  "users" = {"uuid"}
     *         }
     *     )
     * )
     * @OA\Tag(name="AbsencePlan")
     *
     * @param string $uuid
     * @param UnAssignedAbsencePlanRequest $request
     * @param UnAssignedAbsencePlanInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, UnAssignedAbsencePlanRequest $request, UnAssignedAbsencePlanInterface $service): JsonResponse
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