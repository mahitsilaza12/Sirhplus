<?php

namespace Symfony6\Controller\Company\GetSitesCompany;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\GetSitesCompany\FindAllSiteInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company/{uuid}/sites', name: 'get.site.by.company', methods: ['GET'])]
final class GetSitesCompanyController
{
    /**
     * Get sites by company
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
     * @param FindAllSiteInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindAllSiteInterface $service, GetSiteCompanyRequest $request): JsonResponse
    {
        try {
            $request->setUuid($uuid);

            return new JsonResponse(
                $service->execute($request)->getContent(),
                Response::HTTP_OK
            );
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
