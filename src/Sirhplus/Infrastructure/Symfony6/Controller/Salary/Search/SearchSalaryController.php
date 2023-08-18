<?php

namespace Symfony6\Controller\Salary\Search;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\User\Application\Search\SearchUserSalaryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/search-salary', name: 'search.salary', methods: ['GET'])]
final class SearchSalaryController
{
    /**
     * Search user salary
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
     * @OA\Parameter(
     *     name="q",
     *     in="query",
     *     required=true
     * )
     *
     * @OA\Tag(name="Salary")
     * @Security(name="Bearer")
     *
     * @param SearchSalaryRequest $request
     * @param SearchUserSalaryInterface $service
     * @return JsonResponse
     */
    public function __invoke(SearchSalaryRequest $request, SearchUserSalaryInterface $service): JsonResponse
    {
        try {
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
