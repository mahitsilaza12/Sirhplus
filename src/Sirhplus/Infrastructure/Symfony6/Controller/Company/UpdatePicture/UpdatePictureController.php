<?php

namespace Symfony6\Controller\Company\UpdatePicture;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\UpdatePicture\UpdatePictureInterface;
use Sirhplus\Api\Company\Application\UpdatePicture\UpdatePictureRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;

/**
 * class UpdatePictureController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Company\Application\UpdatePicture\UpdatePictureRequest")
 * @package Symfony6\Controller\Company\UpdatePicture
 */
#[Route('/company/{uuid}/picture', name: 'company.update.picture', methods: ['PATCH'])]
final class UpdatePictureController
{
    /**
     * Update picture company
     * @OA\Response(
     *      response = "204",
     *      description = "No content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *             "logo":"string"
     *         }
     *     )
     * )
     * @OA\Tag(name="Company")
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     */
    public function __invoke(
        string $uuid,
        UpdatePictureInterface $service,
        UpdatePictureRequest $request
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
