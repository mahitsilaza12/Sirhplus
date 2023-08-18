<?php

namespace Symfony6\Controller\Salary\EditSalary;

use Sirhplus\Api\Salary\Application\EditSalary\EdiSalaryRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Sirhplus\Api\Salary\Application\EditSalary\EditSalaryInterface;

/**
 * Class AddSalaryController
 * @ParamConverter("request",
 *     converter="request_body_converter",
 *     class="Sirhplus\Api\Salary\Application\EditSalary\EdiSalaryRequest")
 * @package Symfony6\Controller\Salary\EditSalary
 */
#[Route('/salary/{uuid}', name: 'edit.salary', methods: ['PATCH'])]
final class EditSalaryController
{

    /**
     * @OA\Response(
     *      response = "204",
     *      description = "No content"
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
     *         }
     *     )
     * )
     * @OA\Tag(name="Salary")
     *
     * @param string $uuid
     * @param EdiSalaryRequest $request
     * @param EditSalaryInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, EdiSalaryRequest $request, EditSalaryInterface $service): JsonResponse
    {
        try {
            $request->setUuid($uuid);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }        
    }
}
