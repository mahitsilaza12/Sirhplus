<?php

namespace Sirhplus\Api\Subscription\Application\Collections;

interface FindAllSubscriptionInterface
{
    /**
     * @return SubscriptionResponse
     */
    public function execute(): SubscriptionResponse;
}
