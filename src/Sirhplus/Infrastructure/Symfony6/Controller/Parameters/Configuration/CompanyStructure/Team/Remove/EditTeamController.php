<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\Remove;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Remove\RemoveTeamInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\Remove\RemoveTeamRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony6\Controller\ApiController;

/**
 * class EditTeamController
 *
 * @package Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\Remove
 */
#[Route('/team/{uuid}', name: 'remove.team', methods: ['DELETE'])]
final class EditTeamController extends ApiController
{
    /**
     * Remove team
     * @OA\Response(
     *     response=200,
     *     description="Ok"
     * )
     * @OA\Tag(name="Team")
     * @param string $uuid
     * @param RemoveTeamInterface $service
     * @param RemoveTeamRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, RemoveTeamInterface $service, RemoveTeamRequest $request): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $this->validateRequest($request);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
