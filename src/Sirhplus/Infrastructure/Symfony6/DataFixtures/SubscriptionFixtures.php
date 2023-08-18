<?php

namespace Symfony6\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony6\Entity\Subscription;

final class SubscriptionFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['subscription'];
    }

    private static $subscriptions = [
        [
            'type' => 'MENSUAL',
            'rate' => '10',
            'isFree' => 1,
        ],
        [
            'type' => 'ANNUAL',
            'rate' => '120',
            'isFree' => 1,
        ],
        [
            'type' => 'MENSUAL',
            'rate' => '20',
            'isFree' => 0,
        ],
        [
            'type' => 'ANNUAL',
            'rate' => '240',
            'isFree' => 0,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$subscriptions as $subscription) {
            $object = (new Subscription())
                ->setType($subscription['type'])
                ->setRate((float)$subscription['rate'])
                ->setIsFree($subscription['isFree'])
            ;
            $manager->persist($object);
        }

        $manager->flush();
    }
}
