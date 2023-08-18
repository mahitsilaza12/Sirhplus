<?php

namespace Symfony6\Controller\HourlyRegime\UnAssignedSalaryHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\UnassignedSalaryHourlyRegime\UnassignedSalaryHourlyRegimeInterface;
use Sirhplus\Api\HourlyRegime\Application\UnassignedSalaryHourlyRegime\UnassignedSalaryHourlyRegimeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;


/**
 * class UnAssignedSalaryHourlyRegimeController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\HourlyRegime\Application\UnassignedSalaryHourlyRegime\UnassignedSalaryHourlyRegimeRequest")
 * @package Symfony6\Controller\HourlyRegime\UnAssignedSalaryHourlyRegime
 */
#[Route('/hourly-regime/{uuid}/unassigned-salary', name: 'hourly.unassigned.salary', methods: ['PUT'])]
final class UnAssignedSalaryHourlyRegimeController
{
    /**
     * Unassign hourlyRegime to salary
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
     * @OA\Tag(name="HourlyRegime")
     *
     * @param string $uuid
     * @param UnassignedSalaryHourlyRegimeRequest $request
     * @param UnassignedSalaryHourlyRegimeInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, UnassignedSalaryHourlyRegimeRequest $request, UnassignedSalaryHourlyRegimeInterface $service): JsonResponse
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