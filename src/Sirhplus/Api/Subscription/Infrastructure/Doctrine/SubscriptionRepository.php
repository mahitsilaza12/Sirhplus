<?php

namespace Sirhplus\Api\Subscription\Infrastructure\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sirhplus\Api\Company\Domain\CompanyUuid;
use Sirhplus\Api\Subscription\Domain\Repository\SubscriptionRepositoryInterface;
use Sirhplus\Api\Subscription\Domain\SubscriptionResultSet;
use Symfony6\Entity\Subscription;

/**
 * class SubscriptionRepository
 */
final class SubscriptionRepository extends ServiceEntityRepository implements SubscriptionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscription::class);
    }

    /**
     * @return SubscriptionResultSet
     */
    public function fetch(): SubscriptionResultSet
    {
        $subscriptions = $this->createQueryBuilder('o')
            ->getQuery()
            ->execute();

        return new SubscriptionResultSet($subscriptions);
    }
}
