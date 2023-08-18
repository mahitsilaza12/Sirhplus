<?php

namespace Symfony6\Controller\Company\GetUsersSalary;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Company\Application\GetUsersSalary\FindAllUserInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company/{uuid}/users', name: 'users.by-company', methods: ['GET'])]
final class FindUsersSalaryByCompanyController
{
    /**
     * Get all user by company
     *
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *   @OA\JsonContent(
     *         example={
     *      "data":{           
     *                  "id":"integer",
     *                  "firstName":"String",
     *                  "lastName":"String",
     *                  "logo":"String",
     *                  "responsibility":"String",
     *                  "phoneNumber":"String",
     *                  "email":"String",
     *                  "role":{
     *                        "string",
     *                         }
     *                   },
     *      "meta":{
     *                  "total_page":"integer",
     *                   }
     *         }
     *     )
     * )
     * @OA\Tag(name="Company")
     * @Security(name="Bearer")
     * Undocumented function
     *
     * @param string $uuid
     * @param FindAllUserInterface $service
     * @param UserGetCollectionRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        FindAllUserInterface $service,
        UserGetCollectionRequestData $requestData
    ): JsonResponse {
        try{
            $requestData->setUuid($uuid);
            $response = $service->execute($requestData);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
