<?php

namespace Symfony6\Controller\Functions\GetFunctionById;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Functions\Application\GetFunctionById\GetFunctionByIdInterface;
use Sirhplus\Api\Functions\Application\GetFunctionById\GetFunctionByIdRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
#[Route('/function/{uuid}', name: 'find.function', methods: ['GET'])]
final class GetFunctionByIdController
{
    /**
     * Get function by uuid.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     * @OA\JsonContent(
     *         example={
     *             "uuid": "String",
     *             "name": "String",
     *         }
     *     )
     * )
     * @OA\Tag(name="Functions")
     *
     * @param string $uuid
     * @param GetFunctionByIdInterface $service
     * @param GetFunctionByIdRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        GetFunctionByIdInterface $service,
        GetFunctionByIdRequest $request
    ): JsonResponse {
        try{
            $request->setUuid($uuid);
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
