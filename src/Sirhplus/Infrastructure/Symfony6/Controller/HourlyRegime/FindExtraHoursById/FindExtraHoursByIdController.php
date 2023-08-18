<?php

namespace Symfony6\Controller\HourlyRegime\FindExtraHoursById;

use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sirhplus\Api\HourlyRegime\Application\FindExtraHoursById\FindExtraHoursByIdInterface;
use Sirhplus\Api\HourlyRegime\Application\FindExtraHoursById\FindExtraHoursRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

#[Route('/hourly-regime/{uuid}/extra-hours', name: 'find.hourlyRegime.extra.hours.By.Id', methods: ['GET'])]
final class FindExtraHoursByIdController
{

    
    /**
     * Find Extrahours by  uuid HOurlyRegime.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * @OA\JsonContent(
     *         example={
     *        "hourlyRegime":{
     *                  "accountAdditionalHour": "bool",
     *                  "frequency": "String",
     *                  
     *                 }
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     * @param string $uuid
     * @param FindExtraHoursRequest $request
     * @param FindExtraHoursByIdInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindExtraHoursRequest $request, FindExtraHoursByIdInterface $service): JsonResponse
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