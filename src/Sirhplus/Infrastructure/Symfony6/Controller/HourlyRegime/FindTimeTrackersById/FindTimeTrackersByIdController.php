<?php

namespace Symfony6\Controller\HourlyRegime\FindTimeTrackersById;

use Sirhplus\Api\HourlyRegime\Application\FindTimeTrackersById\FindTimeTrackersByIdInterface;
use Sirhplus\Api\HourlyRegime\Application\FindTimeTrackersById\FindTimeTrackersByIdRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('/hourly-regime/{uuid}/time-trackers', name: 'find.hourlyRegime.time.trackers.by.id', methods: ['GET'])]
final class FindTimeTrackersByIdController
{

    /**
     * Find timeTrackers by uuid HourlyRegime .
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * @OA\JsonContent(
     *         example={
     *                  "limite": "bool",
     *                  "limitDay": "int",
     *                  "calculation": "bool",
     *                  "dayCalculation": "int"
     *                  
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param FindTimeTrackersByIdRequest $request
     * @param FindTimeTrackersByIdInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindTimeTrackersByIdRequest $request, FindTimeTrackersByIdInterface $service): JsonResponse
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