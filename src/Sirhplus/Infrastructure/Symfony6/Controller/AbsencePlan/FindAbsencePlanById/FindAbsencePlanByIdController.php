<?php

namespace Symfony6\Controller\AbsencePlan\FindAbsencePlanById;

use Sirhplus\Api\AbsencePlan\Application\FindAbsencePlanById\FindAbsencePlanByIdInterface;
use Sirhplus\Api\AbsencePlan\Application\FindAbsencePlanById\FindAbsencePlanByIdRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;

#[Route('/absence-plan/{uuid}', name: 'find.absence.plan', methods: ['GET'])]
final class FindAbsencePlanByIdController
{

    /**
     * Find AbsencePlan by uuid.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *    @OA\JsonContent(
     *         example={
     *              "name":"string",
     *              "companyUuid":"string",
     * 
     *         }
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Find AbsencePlan by uuid",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="AbsencePlan")
     * @Security(name="Bearer")
     * 
     * 
     * @param string $uuid
     * @param FindAbsencePlanRequest $request
     * @param FindAbsencePlanInterface $service
     * @return JsonResponse
     */
    public function __invoke(string $uuid, FindAbsencePlanByIdRequest $request,  FindAbsencePlanByIdInterface $service): JsonResponse
    {
        try{
            $request->setId($uuid);
            $response =  $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Throwable $e)
        {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], $e->getCode() != 0 ? $e->getCode() : Response::HTTP_BAD_REQUEST);
        }
    }
}