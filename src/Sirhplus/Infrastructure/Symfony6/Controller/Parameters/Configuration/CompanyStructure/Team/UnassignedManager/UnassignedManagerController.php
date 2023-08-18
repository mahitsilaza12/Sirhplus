<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\UnassignedManager;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\UnassignedManager\UnassignedManagerInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\UnassignedManager\UnassignedManagerRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * class EditTeamController
 *
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\UnassignedManager\UnassignedManagerRequest")
 * @package Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\Create
 */
#[Route('/team/{uuid}/unassigned-manager', name: 'team.unassigned.manager', methods: ['PATCH'])]
final class UnassignedManagerController
{
    /**
     * Unassigned manager by team uuid
     * @OA\Response(
     *     response=204,
     *     description="No content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *              "userUuid":"string",
     *         }
     *     )
     * )
     * @OA\Tag(name="Team")
     *
     * @param string $uuid
     * @param UnassignedManagerInterface $service
     * @param UnassignedManagerRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, UnassignedManagerInterface $service, UnassignedManagerRequest $request): JsonResponse
    {
        try {
            $request->setTeamUuid($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
