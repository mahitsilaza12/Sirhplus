<?php

namespace Symfony6\Controller\Company\AssignProperty;

use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\AssignProperty\AssignPropertyInterface;
use Sirhplus\Api\Company\Application\AssignProperty\AssignPropertyRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company/{uuidCompany}/assign-property/{uuidSalary}', name: 'assign-property.company', methods: ['PATCH'])]
final class AssignPropertyController
{
    /**
     * Assign company property
     *
     * @OA\Response(
     *      response = "204",
     *      description = "No Content"
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Assign propety to company",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Company")
     * @Security(name="Bearer")
     *
     * @param string $uuidCompany
     * @param string $uuidSalary
     * @param AssignPropertyInterface $service
     * @param AssignPropertyRequest $request
     */
    public function __invoke(
        string $uuidCompany,
        string $uuidSalary,
        AssignPropertyInterface $service,
        AssignPropertyRequest $request
    ): JsonResponse {
        try {
            $request->setUuid($uuidCompany);
            $request->setUserUuid($uuidSalary);
            $service->execute($request);

            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
