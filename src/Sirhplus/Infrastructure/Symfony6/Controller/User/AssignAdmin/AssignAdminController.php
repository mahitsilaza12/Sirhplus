<?php

namespace Symfony6\Controller\User\AssignAdmin;

use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\User\Application\AssignAdminToCompany\AssignAdminRequest;
use Sirhplus\Api\User\Application\AssignAdminToCompany\AssignAdminToCompanyInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddCompanyController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\User\Application\AssignAdminToCompany\AssignAdminRequest")
 * @package Symfony6\Controller\Company\AssignAdmin
 */
#[Route('/company/{uuid}/assign-admin', name: 'assign-admin.company', methods: ['PATCH'])]
final class AssignAdminController
{
    /**
     * Assign admin by company
     * @OA\Response(
     *      response = "204",
     *      description = "No Content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *           {
     *              "users": {0}
     *           }
     *        }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Assign admin to company",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="User")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param AssignAdminToCompanyInterface $service
     * @param AssignAdminRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string                        $uuid,
        AssignAdminToCompanyInterface $service,
        AssignAdminRequest            $request
    ): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
