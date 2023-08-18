<?php

namespace Symfony6\Controller\HourlyRegime\RemoveHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\RemoveHourlyRegime\RemoveHourlyRegimeInterface;
use Sirhplus\Api\HourlyRegime\Application\RemoveHourlyRegime\RemoveHourlyRegimeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class RemoveHourlyRegimeController
 * @package Symfony6\Controller\HourlyRegime\RemoveHourlyRegime
 */
#[Route('/hourly-regime/{uuid}', name: 'remove.hourlyRegime', methods: ['DELETE'])]
final class RemoveHourlyRegimeController
{
    /**
     * delete hourly regime by uuid
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param RemoveHourlyRegimeRequest $request
     * @param RemoveHourlyRegimeInterface $service
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        RemoveHourlyRegimeRequest $request,
        RemoveHourlyRegimeInterface $service
    ): JsonResponse {
        try {
            $request->setId($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_OK);
        } catch(\Exception $e) {

            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }    
    }
}