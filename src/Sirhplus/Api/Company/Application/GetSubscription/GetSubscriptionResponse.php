<?php

namespace Sirhplus\Api\Company\Application\GetSubscription;

use Sirhplus\Shared\Service\Response;

/**
 * class GetSubscriptionResponse
 */
final class GetSubscriptionResponse implements Response
{
    /** @var array  */
    private array $data = [];

    /**
     * @param object $object
     */
    public function __construct(private readonly object $object)
    {
        $this->data = [];
        $this->mapping();
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->data;
    }

    /**
     * @return void
     */
    private function mapping(): void
    {
        $subscription = $this->object->getSubscription();

        if ($subscription) {
            $this->data = [
                'id' => $subscription->getId()->toRfc4122(),
                'type' => $subscription->getType(),
                'rate' => $subscription->getRate(),
                'expiredIn' => !$subscription->getExpiredIn() ?: $subscription->getExpiredIn()->format('Y-m-d'),
                'isPay' => $subscription->isFree(),
            ];
        }
    }
}
