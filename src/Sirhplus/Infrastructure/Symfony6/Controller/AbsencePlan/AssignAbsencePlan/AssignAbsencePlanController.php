<?php

namespace Symfony6\Controller\AbsencePlan\AssignAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\AssignAbsencePlan\AssignAbsencePlanInterface;
use Sirhplus\Api\AbsencePlan\Application\AssignAbsencePlan\AssignAbsencePlanRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * class AssignAbsencePlanController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\AbsencePlan\Application\AssignAbsencePlan\AssignAbsencePlanRequest")
 * @package Symfony6\Controller\AbsencePlan\AssignAbsencePlan
 */
#[Route('/absence-plan/{uuid}/assigned-salary', name: 'absence.assigned.salary', methods: ['PUT'])]
final class AssignAbsencePlanController
{
     
    /**
     * Add assign AbsencePlan to salary
     * @OA\Response(
     *     response=200,
     *     description="Ok"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  "salaries" = "array"
     *         }
     *     )
     * )
     * @OA\Tag(name="AbsencePlan")
     *
     * @param string $uuid
     * @param AssignAbsencePlanRequest $request
     * @param AssignAbsencePlanInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, AssignAbsencePlanRequest $request, AssignAbsencePlanInterface $service): JsonResponse
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