<?php

namespace Symfony6\Controller\Company\Collections;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\Collections\FindAllCompany;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * class FindAllCompanyController
 */
#[Route('/companies', name: 'fetch.company', methods: ['GET'])]
final class FindAllCompanyController
{
    /**
     * Show all company
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *     @OA\JsonContent(
     *         example={
     *      "data":{
     *                  "uuid": "string",
     *                  "information":{
     *                       "name":"string",
     *                       "logo":"string",
     *                   },
     *                  "effective":"string",
     *                  "subscription":{
     *                       "uuid":"string",
     *                       "type":"string",
     *                       "isPay":"boolean",
     *                       "expiresIn":"string",
     *                   },
     *                  "contact":{
     *                        "email":"string",
     *                        "phoneNumber":"string",
     *                   }
     *      },
     *      "meta":{
     *                "total_page":"integer",
     *             }
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Show all company",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Company")
     *
     * @param FindAllCompany $company
     * @param CompanyGetCollectionRequestData $requestData
     * @return JsonResponse
     */
    public function __invoke(
        FindAllCompany $company,
        CompanyGetCollectionRequestData $requestData
    ): JsonResponse {
        try {
            $response = $company->execute($requestData);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
