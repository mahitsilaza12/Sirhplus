<?php

namespace Symfony6\Controller\Functions\Edit;

use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\Functions\Application\EditFunction\EditFunctionInterface;
use Sirhplus\Api\Functions\Application\EditFunction\EditFunctionRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as SecurityInterface;

/**
 * Class AddCompanyController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Functions\Application\EditFunction\EditFunctionRequest")
 * @package Symfony6\Controller\Functions\Add
 */
#[Route('/function/{uuid}', name: 'edit.function', methods: ['PUT'])]
final class EditFunctionController
{
    /**
     * Edit function by uuid
     *
     * @OA\Response(
     *     response=204,
     *     description="No Content"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *             "name":"String"
     *         }
     *     )
     * )
     * @OA\Tag(name="Functions")
     *
     * @SecurityInterface("hasAccessRight(['ROLE_SUPER_ADMIN'])")
     * @param string $uuid
     * @param EditFunctionInterface $service
     * @param EditFunctionRequest $request
     * @return JsonResponse
     */
    public function __invoke(string $uuid, EditFunctionInterface $service, EditFunctionRequest $request): JsonResponse
    {
        try {
            $request->setId($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
