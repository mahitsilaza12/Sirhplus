<?php

namespace Symfony6\Controller\HourlyRegime\FindHourlyRegime;

use Sirhplus\Api\HourlyRegime\Application\FindHourlyRegimeById\FindHourlyRegimeInterface;
use Sirhplus\Api\HourlyRegime\Application\FindHourlyRegimeById\FindHourlyRegimeRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('/hourly-regime/{uuid}', name: 'find.hourlyRegime', methods: ['GET'])]
final class FindHourlyRegimeByIdController
{

    /**
     * Find HourlyRegime by uuid.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * @OA\JsonContent(
     *         example={
     *        "hourlyRegime":{
     *                  "name": "String",
     *                  
     *                 }
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param FindHourlyRegimeRequest $request
     * @param FindHourlyRegimeInterface $service
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        FindHourlyRegimeRequest $request,
        FindHourlyRegimeInterface $service
    ): JsonResponse {
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