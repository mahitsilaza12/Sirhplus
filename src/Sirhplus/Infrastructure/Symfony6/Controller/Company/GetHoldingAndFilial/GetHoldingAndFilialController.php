<?php

namespace Symfony6\Controller\Company\GetHoldingAndFilial;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Company\Application\GetHoldingAndFilial\GetHoldingAndFilialByCompanyIdInterface;
use Sirhplus\Api\Company\Application\GetHoldingAndFilial\GetHoldingAndFilialRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetHoldingAndFilialController
 * @package Symfony6\Controller\Company\GetHoldingAndFilial
 */
#[Route('/company/{uuid}/children', name: 'get.company.children', methods: ['GET'])]
final class GetHoldingAndFilialController
{
    /**
     * @OA\Response(
     *     response=200,
     *     description="Response of company",
     *     @OA\JsonContent(
     *        example={
     *           {
     *               "id": 0,
     *               "name": "string",
     *               "logo": "path",
     *               "type": "HOLDING|FILIAL",
     *           },
     *           {
     *               "id": 0,
     *               "name": "string",
     *               "logo": "path",
     *               "type": "HOLDING|FILIAL"
     *           }
     *        },
     *     )
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Get holding and filial by company",
     *     @OA\Schema(type="string")
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Get holding and filial by company",
     *     @OA\Schema(type="string")
     * )
     * @OA\Tag(name="Company")
     * @Security(name="Bearer")
     *
     * @param string $uuid
     * @param GetHoldingAndFilialRequest $request
     * @param GetHoldingAndFilialByCompanyIdInterface $service
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        GetHoldingAndFilialRequest $request,
        GetHoldingAndFilialByCompanyIdInterface $service
    ): JsonResponse {
        try {
            $request->setUuid($uuid);

            return new JsonResponse(
                $service->execute($request)->data,
                Response::HTTP_OK
            );
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
