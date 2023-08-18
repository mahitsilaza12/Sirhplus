<?php

namespace Symfony6\Controller\Functions\Add;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\Functions\Application\AddFunction\AddFunctionInterface;
use Sirhplus\Api\Functions\Application\AddFunction\AddFunctionRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * Class AddFunctionController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Functions\Application\AddFunction\AddFunctionRequest")
 * @package Symfony6\Controller\Functions\Add
 */
#[Route('/function', name: 'add.function', methods: ['POST'])]
final class AddFunctionController
{
    /**
     * Add new function
     * @OA\Response(
     *     response=200,
     *     description="Ok"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  "companyUuid":"string",
     *                  "name":"string",
     *         }
     *     )
     * )
     * @OA\Tag(name="Functions")
     *
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     * @param AddFunctionInterface $service
     * @param AddFunctionRequest $request
     * @return JsonResponse
     */
    public function __invoke(AddFunctionInterface $service, AddFunctionRequest $request): JsonResponse
    {
        try {
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
