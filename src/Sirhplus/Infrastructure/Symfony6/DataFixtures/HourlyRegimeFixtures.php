<?php

namespace Symfony6\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony6\Entity\HourlyRegime;

final class HourlyRegimeFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['HourlyRegime'];
    }

    private static $HourlyRegimes = [
        [
            'name' => 'Temps partiel (3 jours)'
        ],
        [
            'name' => 'Temps partiel (5 jours) '
        ],
        [
            'name' => 'Temps plein(35h)'
        ],
        [
            'name' => 'Temps plein(37.5h)'
        ],
        [
            'name' => 'Temps plein(40h)'
        ],
        [
            'name' => 'Travail de nuit'
        ]
        ];
    public function load(ObjectManager $manager): void
    {   
        foreach(self::$HourlyRegimes as $HourlyRegime) {
            $objet = (new HourlyRegime())
                ->setName($HourlyRegime['name']);
            $manager->persist($objet);
        }
        $manager->flush();
    }
}