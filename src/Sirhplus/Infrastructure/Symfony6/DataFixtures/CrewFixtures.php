<?php

namespace Symfony6\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony6\Entity\Crew;

final class CrewFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['Crew'];
    }

    private static $crews = [
        [
            'name' => 'Commercial'
        ],
        [
            'name' => 'Entreprise'
        ],
        [
            'name' => 'Informatique'
        ],
        [
            'name' => 'Administratif'
        ],
        [
            'name' => 'Chantier'
        ],
        [
            'name' => 'Macon'
        ],
        [
            'name' => 'Marketing'
        ],
        [
            'name' => 'Ressource humaine'
        ]
        ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::$crews as $crew) {
            $objet = (new Crew())
                ->setName($crew['name']);
            $manager->persist($objet);
        }
        $manager->flush();
    }
}