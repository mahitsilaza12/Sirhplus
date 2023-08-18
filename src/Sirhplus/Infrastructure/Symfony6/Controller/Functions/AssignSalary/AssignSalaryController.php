<?php

namespace Symfony6\Controller\Functions\AssignSalary;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Functions\Application\AssignSalary\AssignSalaryInterface;
use Sirhplus\Api\Functions\Application\AssignSalary\AssignSalaryRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony6\Controller\ApiController;

/**
 * Class AddFunctionController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Functions\Application\AssignSalary\AssignSalaryRequest")
 * @package Symfony6\Controller\Functions\Add
 */
#[Route('/function/{uuid}/assign-salary', name: 'function.assign.salary', methods: ['PUT'])]
final class AssignSalaryController extends ApiController
{
    /**
     * Assign salary by function uuid
     * @OA\Response(
     *     response=200,
     *     description="Ok"
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *              "salaries" : "array"
     *         }
     *     )
     * )
     * @OA\Tag(name="Functions")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param AssignSalaryRequest $request
     * @param AssignSalaryInterface $service
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        AssignSalaryRequest $request,
        AssignSalaryInterface $service
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
