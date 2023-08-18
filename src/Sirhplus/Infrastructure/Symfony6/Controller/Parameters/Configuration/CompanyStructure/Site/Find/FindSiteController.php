<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Site\Find;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Find\FindSiteInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Find\FindSiteRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony6\Controller\ApiController;

#[Route('/site/{uuid}', name: 'find.site', methods: ['GET'])]
final class FindSiteController extends ApiController
{
    /**
     * Find site by uuid
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * @OA\JsonContent(
     *         example={
     *             "id": "string",
     *             "name": "String",
     *         }
     *     )
     * )
     * @OA\Tag(name="Site")
     *
     * @param string $uuid
     * @param FindSiteInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindSiteInterface $service, FindSiteRequest $request): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $this->validateRequest($request);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
