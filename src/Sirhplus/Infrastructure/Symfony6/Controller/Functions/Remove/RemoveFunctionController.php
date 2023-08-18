<?php

namespace Symfony6\Controller\Functions\Remove;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Functions\Application\RemoveFunction\RemoveFunctionInterface;
use Sirhplus\Api\Functions\Application\RemoveFunction\RemoveFunctionRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;

/**
 * Class AddFunctionController
 * @package Symfony6\Controller\Functions\Remove
 */
#[Route('/function/{uuid}', name: 'remove.function', methods: ['DELETE'])]
final class RemoveFunctionController
{
    /**
     * Remove function by uuid
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\Tag(name="Functions")
     * @Security(name="Bearer")
     *
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     *
     * @param string $uuid
     * @param RemoveFunctionInterface $service
     * @param RemoveFunctionRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        RemoveFunctionInterface $service,
        RemoveFunctionRequest $request
    ): JsonResponse {
        try {
            $request->setId($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
