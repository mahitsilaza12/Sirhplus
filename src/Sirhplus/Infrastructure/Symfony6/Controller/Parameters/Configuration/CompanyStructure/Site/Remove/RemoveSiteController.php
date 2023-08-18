<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Site\Remove;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Remove\RemoveSiteInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Site\Application\Remove\RemoveSiteRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony6\Controller\ApiController;

/**
 * class RemoveSiteController
 */
#[Route('/site/{uuid}', name: 'remove.site', methods: ['DELETE'])]
final class RemoveSiteController extends ApiController
{
    /**
     * Remove site by uuid
     * @OA\Response(
     *      response = "200",
     *      description = "OK"
     * )
     * @OA\Tag(name="Site")
     * @param string $uuid
     * @param RemoveSiteInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, RemoveSiteInterface $service, RemoveSiteRequest $request): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $this->validateRequest($request);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
