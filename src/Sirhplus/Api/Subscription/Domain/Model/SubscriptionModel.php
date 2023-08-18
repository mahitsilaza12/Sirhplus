<?php

namespace Sirhplus\Api\Subscription\Domain\Model;

/**
 * class SubscriptionModel
 */
final class SubscriptionModel
{
    /**
     * @param string $uuid
     * @param string $type
     * @param float $rate
     * @param \DateTime|null $expiredIn
     * @param bool $isPay
     *
     */
    public function __construct(
        private readonly string $uuid,
        private readonly string $type,
        private readonly float $rate,
        private readonly \DateTime|null $expiredIn,
        private readonly bool $isPay,
    ) {
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return [
            'id' => $this->uuid,
            'type' => $this->type,
            'rate' => $this->rate,
            'expiredIn' => !$this->expiredIn ?: $this->expiredIn->format('Y-m-d'),
            'isPay' => $this->isPay,
        ];
    }
}
