<?php

namespace Symfony6\Controller\Company\GetAbsencePlan;

use Sirhplus\Api\Company\Application\GetAbsencePlan\FindAllAbsencePlanInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

#[Route('/company/{uuid}/absence-plan', name: 'get.absence.plan.by.company', methods: ['GET'])]
final class GetFindAllAbsencePlanByCompanyController 
{
    /**
     * Get all absence plan by company
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *              "data":{
     *                  {
     *                      "id":"string",
     *                      "name":"string",
     *                      "salary":"integer",
     *                  }
     *              },
     *              "meta":{
     *                  "total_page":"integer",
     *              }
     *         }
     *     )
     * )
     * @OA\Tag(name="Company")
     *
     * @param string $uuid
     * @param FindAllAbsencePlanInterface $service
     * @param GetAbsencePlanRequestData $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindAllAbsencePlanInterface $service, GetAbsencePlanRequestData $request): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }  
    }
}