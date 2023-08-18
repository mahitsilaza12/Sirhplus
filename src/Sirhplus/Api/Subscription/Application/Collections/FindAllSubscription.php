<?php

namespace Sirhplus\Api\Subscription\Application\Collections;

use Sirhplus\Api\Subscription\Domain\Repository\SubscriptionRepositoryInterface;

/**
 * class FindAllSubscription
 */
final class FindAllSubscription implements FindAllSubscriptionInterface
{
    public function __construct(private readonly SubscriptionRepositoryInterface $repository)
    {
    }

    /**
     * @return SubscriptionResponse
     */
    public function execute(): SubscriptionResponse
    {
        return new SubscriptionResponse(
            $this->repository->fetch()->getContent()
        );
    }
}
