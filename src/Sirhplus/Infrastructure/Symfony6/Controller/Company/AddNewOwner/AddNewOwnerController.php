<?php

namespace Symfony6\Controller\Company\AddNewOwner;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\AddNewOwner\AddNewOwnerInterface;
use Sirhplus\Api\Company\Application\AddNewOwner\AddNewOwnerRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;

/**
 * Class AddCompanyController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Company\Application\AddCompany\AddCompanyRequest")
 * @package Symfony6\Controller\Company\AddNewOwner
 */
#[Route('/company/{uuid}/owner', name: 'add.owner.by.company', methods: ['POST'])]
final class AddNewOwnerController
{
    /**
     * Add new owner by company
     * @OA\Response(
     *      response = "200",
     *      description = "OK"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *            "uuid": "string"
     *         }
     *     )
     * )
     * @OA\Tag(name="Company")
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     */
    public function __invoke(string $uuid, AddNewOwnerInterface $service, AddNewOwnerRequest $request): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
