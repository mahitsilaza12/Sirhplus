<?php

namespace Symfony6\Controller\Salary\AddSalary;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sirhplus\Api\Salary\Application\AddSalary\AddSalaryRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Salary\Application\AddSalary\AddSalaryInterface;

/**
 * class AddSalaryController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Salary\Application\AddSalary\AddSalaryRequest")
 * @package Symfony6\Controller\Salary\AddSalary
 */
#[Route('/salary', name: 'add.salary', methods: ['POST'])]
final class AddSalaryController
{
    /**
     * Create new salary
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *      @OA\JsonContent(
     *        @OA\Property(type = "string", property = "uuid")
     *      )
     * )
     * @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *         example={
     *                  "firstname":"string",
     *                  "lastname":"string",
     *                  "email":"string",
     *                  "phone":"string",
     *                  "dateOfBirth":"string",
     *                  "sex":"string",
     *                  "companyUuid":"string",
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="salary",
     *     in="query",
     *     description="The field salary",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Salary")
     * @Security(name="Bearer")
     * 
     * @param AddSalaryRequest $request
     * @param AddSalaryInterface $service
     * @return JsonResponse
     */
    public function __invoke(AddSalaryRequest $request, AddSalaryInterface $service): JsonResponse
    {
        try {
            $response = $service->execute($request);
            
            return new JsonResponse($response->getContent(), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
