<?php

namespace Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\AssignManager;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignManager\AssignManagerInterface;
use Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignManager\AssignManagerRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * class CreateSiteController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Parameters\Configuration\CompanyStructure\Team\Application\AssignManager\AssignManagerRequest")
 * @package Symfony6\Controller\Parameters\Configuration\CompanyStructure\Team\AssignManager
 */
#[Route('/team/{uuid}/assign-manager', name: 'team.assign.manager', methods: ['PATCH'])]
final class AssignManagerController
{
    /**
     * Assign salary
     *
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *              "users":"array",
     *         }
     *     )
     * )
     * @OA\Tag(name="Team")
     *
     * @param string $uuid
     * @param AssignManagerInterface $service
     * @param AssignManagerRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, AssignManagerInterface $service, AssignManagerRequest $request): JsonResponse
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
