<?php

namespace Symfony6\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony6\Entity\Site;

final class SiteFixture extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['site'];
    }

    private static $sites =[
        [
            'name' => 'Siège'
        ],
        [
            'name' => 'Télétravail'
        ]
        ];
    
    public function load(ObjectManager $manager): void
    {
        foreach(self::$sites as $site) {
            $objet = (new Site())
                    ->setName($site['name']);
        $manager->persist($objet);
        }

        $manager->flush();
    }
}