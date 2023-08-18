<?php

namespace Symfony6\Controller\Company\UnassignedAdmin;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\UnassignedAdmin\UnassignedAdminInterface;
use Sirhplus\Api\Company\Application\UnassignedAdmin\UnassignedAdminRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;

/**
 * Class UnassignedAdminController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Company\Application\UnassignedAdmin\UnassignedAdminRequest")
 * @package Symfony6\Controller\Company\UnassignedAdmin
 */
#[Route('/company/{uuid}/administrators', name: 'company.unassigned.admin', methods: ['PATCH'])]
final class UnassignedAdminController
{
    /**
     * Unassigned admin to company
     * @OA\Response(
     *      response = "204",
     *      description = "No content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *             "administratorsUuid": "array"
     *         }
     *     )
     * )
     * @OA\Tag(name="Company")
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     */
    public function __invoke(
        string $uuid,
        UnassignedAdminRequest $request,
        UnassignedAdminInterface $service
    ): JsonResponse {
        try {
            $request->setCompanyUuid($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
