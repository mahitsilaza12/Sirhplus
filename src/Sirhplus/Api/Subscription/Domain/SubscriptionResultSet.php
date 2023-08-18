<?php

namespace Sirhplus\Api\Subscription\Domain;

use Sirhplus\Api\Subscription\Domain\Model\SubscriptionModel;

/**
 * class SubscriptionResultSet
 */
final class SubscriptionResultSet
{
    /**
     * @param array $data
     */
    public function __construct(private readonly array $data)
    {
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return array_map(function ($value) {
            return (new SubscriptionModel(
                $value->getId()->toRfc4122(),
                $value->getType(),
                $value->getRate(),
                $value->getExpiredIn(),
                $value->isFree()
            ))->getContent();
        }, $this->data);
    }
}
