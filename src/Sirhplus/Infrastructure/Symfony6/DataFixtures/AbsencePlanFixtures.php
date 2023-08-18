<?php

namespace Symfony6\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony6\Entity\AbsencePlan;

final class AbsencePlanFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['AbsencePlan'];
    }

    private static $absencePlans = [
        [
            'name' => 'Stagiaire'
        ],
        [
            'name' => 'Temps partiel'
        ],
        [
            'name' => 'Temps plein'
        ],
        [
            'name' => 'Apprentis'
        ]
        ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::$absencePlans as $absencePlan) {
            $objet = (new AbsencePlan())
                ->setName($absencePlan['name']);
            $manager->persist($objet);
        }        
        $manager->flush();
    }
}