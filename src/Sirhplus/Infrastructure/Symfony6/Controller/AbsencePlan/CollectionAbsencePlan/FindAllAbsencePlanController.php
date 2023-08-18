<?php

namespace Symfony6\Controller\AbsencePlan\CollectionAbsencePlan;

use Sirhplus\Api\AbsencePlan\Application\CollectionAbsencePlan\CollectionAbsencePlanInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

#[Route('/absence-plan', name: 'fetch.absence.plan', methods: ['GET'])]
final class FindAllAbsencePlanController
{
    /**
     * Show all AbsencePlan
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *      "data":{           
     *                  "uuid":"String",
     *                  "name":"String"
     *             },
     *      "meta":{
     *                  "Total_page":"integer",
     *                   }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Show all AbsencePlan",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="AbsencePlan")
     * @Security(name="Bearer")
     *
     * @param CollectionAbsencePlanInterface $service
     * @param AbsencePlanGetCollectionRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke(CollectionAbsencePlanInterface $service, AbsencePlanGetCollectionRequestData $requestData): JsonResponse
    {
        try {
            $response = $service->execute($requestData);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}