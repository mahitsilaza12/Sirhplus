<?php

namespace Symfony6\Controller\Company\GetSubscription;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use OpenApi\Annotations as OA;
use Sirhplus\Api\Company\Application\GetSubscription\GetSubscriptionInterface;
use Sirhplus\Api\Company\Application\GetSubscription\GetSubscriptionRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/company/{uuid}/subscription', name: 'find.company.subscription', methods: ['GET'])]
final class GetSubscriptionController
{
    /**
     * Find Company subscription by uuid.
     * @OA\Response(
     *      response = "200",
     *      description = "OK",
     *    @OA\JsonContent(
     *         example={
     *              "id":"string",
     *              "type":"string",
     *              "rate":"int",
     *              "expiredIn":"string",
     *              "isPay":"bool",
     *         }
     *     )
     * )
         * @OA\Tag(name="Company")
     *
     * @param string $uuid
     * @param GetSubscriptionInterface $service
     * @param GetSubscriptionRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        string $uuid,
        GetSubscriptionInterface $service,
        GetSubscriptionRequest $request
    ): JsonResponse {
        try {
            $request->setUuid($uuid);
            $response = $service->execute($request);

            return new JsonResponse($response->getContent(), Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], $e->getCode() != 0 ? $e->getCode() : Response::HTTP_BAD_REQUEST);
        }
    }
}
