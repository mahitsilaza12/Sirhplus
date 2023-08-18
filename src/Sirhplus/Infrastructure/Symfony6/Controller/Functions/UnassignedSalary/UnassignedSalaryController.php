<?php

namespace Symfony6\Controller\Functions\UnassignedSalary;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Salary\Application\UnassignedFunction\UnassignedFunctionInterface;
use Sirhplus\Api\Salary\Application\UnassignedFunction\UnassignedFunctionRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony6\Controller\ApiController;

/**
 * Class AddFunctionController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Salary\Application\UnassignedFunction\UnassignedFunctionRequest")
 * @package Symfony6\Controller\Functions\Add
 */
#[Route('/function/{uuid}/unassigned-salary', name: 'function.unassigned.salary', methods: ['PUT'])]
final class UnassignedSalaryController extends ApiController
{
    /**
     * Unassigned salary by function uuid
     * @OA\Response(
     *     response=200,
     *     description="Ok"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *              "user": "string"
     *         }
     *     )
     * )
     * @OA\Tag(name="Functions")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param UnassignedFunctionRequest $request
     * @param UnassignedFunctionInterface $service
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        UnassignedFunctionRequest $request,
        UnassignedFunctionInterface $service
    ): JsonResponse {
        try {
            $request->setUuid($uuid);
            $this->validateRequest($request);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
