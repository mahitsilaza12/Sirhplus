<?php

namespace Symfony6\Controller\Subscription\Collections;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sirhplus\Api\Subscription\Application\Collections\FindAllSubscriptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/subscriptions', name: 'fetch.subscriptions', methods: ['GET'])]
final class FindAllSubscriptionController
{
    /**
     * @OA\Response(
     *     response=200,
     *     description="Response of subscription"
     * )
     * @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Show all subscription"
     * )
     * @OA\Tag(name="Subscription")
     * @Security(name="Bearer")
     * @param FindAllSubscriptionInterface $service
     * @return JsonResponse
     */
    public function __invoke(FindAllSubscriptionInterface $service): JsonResponse
    {
        try {
            return new JsonResponse(
                $service->execute()->data,
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
