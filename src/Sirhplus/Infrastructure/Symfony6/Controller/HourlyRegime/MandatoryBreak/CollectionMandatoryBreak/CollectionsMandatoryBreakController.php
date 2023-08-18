<?php

namespace Symfony6\Controller\HourlyRegime\MandatoryBreak\CollectionMandatoryBreak;

use Sirhplus\Api\MandatoryBreak\Application\Collections\CollectionMandatoryBreakInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('/hourly-regime/{hourlyRegimeId}/mandatory-breaks', name: 'fetch.mandatoryBreaks', methods: ['GET'])]
final class CollectionsMandatoryBreakController
{

    /**
     * Show all mandatoryBreaks by hourly regime
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *   @OA\JsonContent(
     *         example={
     *      "data":{           
     *                  "uuid":"String",
     *                  "name":"String",
     *                  "workingTimes":"String",
     *                  "pause":"String",
     *                   },
     *      "meta":{
     *                  "Total_page":"int",
     *                   }
     *         }
     *     )
     * )
     * @OA\Tag(name="HourlyRegime")
     * @Security(name="Bearer")
     * 
     *
     * @param CollectionMandatoryBreakInterface $service
     * @param MandatoryBreakGetCollectionsRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke(CollectionMandatoryBreakInterface $service, MandatoryBreakGetCollectionsRequestData $requestData):JsonResponse
    {
        try {
            $response = $service->execute($requestData);
 
             return new JsonResponse($response->getContent(), Response::HTTP_OK);
         } catch(\Exception $e) {
             return new JsonResponse([
                 'error' => $e->getMessage(),
             ],Response::HTTP_BAD_REQUEST);
         }
    }
}