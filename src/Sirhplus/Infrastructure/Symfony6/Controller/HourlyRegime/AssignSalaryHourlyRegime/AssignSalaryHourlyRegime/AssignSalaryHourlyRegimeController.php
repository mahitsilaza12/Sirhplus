<?php

namespace Symfony6\Controller\HourlyRegime\AssignSalaryHourlyRegime\AssignSalaryHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\AssignSalaryHourlyRegime\AssignSalaryHourlyRegimeInterface;
use Sirhplus\Api\HourlyRegime\Application\AssignSalaryHourlyRegime\AssignSalaryHourlyRegimeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * class AssignSalaryHourlyRegimeController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\HourlyRegime\Application\AssignSalaryHourlyRegime\AssignSalaryHourlyRegimeRequest")
 * @package Symfony6\Controller\HourlyRegime\AssignSalaryHourlyRegime\AssignSalaryHourlyRegime
 */
#[Route('/hourly-regime/{uuid}/assigned-salary', name: 'hourly.assigned.salary', methods: ['PUT'])]
final class AssignSalaryHourlyRegimeController
{

    /**
     * Add assign hourlyRegime to salary
     * @OA\Response(
     *     response=200,
     *     description="Ok"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                "salaries" : "array"
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     *
     * @param string $uuid
     * @param AssignSalaryHourlyRegimeRequest $request
     * @param AssignSalaryHourlyRegimeInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, AssignSalaryHourlyRegimeRequest $request, AssignSalaryHourlyRegimeInterface $service): JsonResponse
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