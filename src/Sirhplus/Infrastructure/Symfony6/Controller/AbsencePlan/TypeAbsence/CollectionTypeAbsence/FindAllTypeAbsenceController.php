<?php

namespace Symfony6\Controller\AbsencePlan\TypeAbsence\CollectionTypeAbsence;

use Sirhplus\Api\TypeAbsence\Application\CollectionTypeAbsence\CollectionTypeAbsenceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * class FindAllTypeAbsenceController
 */
#[Route('/absence-plan/absence-type', name: 'fetch.absence.type', methods: ['GET'])]
final class FindAllTypeAbsenceController
{

    /**
     * Show all TypeAbsence
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *      "data":{           
     *                  "uuid":"String",
     *                  "type":"String",
     *                  "color":"String",
     *                  "visibility":"bool"
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
     *     description="Show all TypeAbsence",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="AbsencePlan")
     * @Security(name="Bearer")
     *
     *
     * @param CollectionTypeAbsenceInterface $service
     * @param TypeAbsenceGetCollectionRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke(CollectionTypeAbsenceInterface $service, TypeAbsenceGetCollectionRequestData $requestData) :JsonResponse
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