<?php

namespace Symfony6\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony6\Entity\Company;
use Symfony6\Entity\Functions;
use Symfony6\Entity\Salary;
use Symfony6\Entity\User;

final class CompanyFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public static function getGroups(): array
    {
        return ['company'];
    }

    private static $company = [
        'name' => 'Vision additionnelles',
        'logo' => 'logo',
        'legalStructure' => 'SAS',
        'socialReason' => 'SAS',
        'createdAt' => '2010-10-10',
        'sales' => 10,
        'address' => '10 Rue des Entrepreneurs, 29290 Saint-Renan',
        'postalCode' => '75200',
        'city' => 'France',
        'site' => 'https://www.visions-additionnelles.fr/',
        'phoneNumber' => ' 02 98 42 17 34',
        'leadingStatus' => 'SAS',
        'schedule' => 'SAS',
        'assignment' => 'Comités Sociaux et Economiques',
        'siren' => '362 521 879',
        'siret' => '123 568 941',
        'tva' => '20',
        'rcs' => 'RCS PARIS B 517 403 572',
        'sector' => 'Accompagnement entreprise',
        'code' => 'XY9-UYH',
        'details' => 'Notre nom, Visions Additionnelles, est un résumé de ce qui nous motive à travailler avec vous',
        'idcc' => '1486',
        'provisioning' => 'Vision additionnelles',
        'healthComplementary' => 'Vision additionnelles',
        'pensionFund' => 'Vision additionnelles',
    ];

    private static $users = [
        [
            'email' => 'supadmin@test.com',
            'password' => '123456789',
            'responsibility' => 'Super admin',
            'sex' => 'M',
            'roles' => ['ROLE_SUPER_ADMIN'],
        ],
        [
            'email' => 'fabriola@test.com',
            'password' => '123456789',
            'responsibility' => 'Super admin',
            'sex' => 'M',
            'roles' => ['ROLE_SUPER_ADMIN'],
        ],
        [
            'email' => 'owner@test.com',
            'password' => '123456789',
            'responsibility' => 'Owner',
            'sex' => 'M',
            'roles' => ['ROLE_OWNER'],
        ],
        [
            'email' => 'admin@test.com',
            'password' => '123456789',
            'responsibility' => 'Admin',
            'sex' => 'M',
            'roles' => ['ROLE_ADMIN'],
        ],

        [
            'email' => 'davidson@test.com',
            'password' => '123456789',
            'responsibility' => 'Admin',
            'sex' => 'M',
            'roles' => ['ROLE_ADMIN'],
        ],
        [
            'email' => 'team@test.com',
            'password' => '123456789',
            'responsibility' => 'Team',
            'sex' => 'M',
            'roles' => ['ROLE_TEAM_RESPONSIBILITY'],
        ],

        [
            'email' => 'oskar@test.com',
            'password' => '123456789',
            'responsibility' => 'Team',
            'sex' => 'M',
            'roles' => ['ROLE_TEAM_RESPONSIBILITY'],
        ],
        [
            'email' => 'user@test.com',
            'password' => '123456789',
            'responsibility' => 'User',
            'sex' => 'M',
            'roles' => ['ROLE_USER'],
        ],
        [
            'email' => 'oskardavis@test.com',
            'password' => '123456789',
            'responsibility' => 'User',
            'sex' => 'M',
            'roles' => ['ROLE_USER'],
        ],
    ];

    private static array $functions = [
        [
            'name' =>'Chef de chantier'
        ],
        [
            'name' => 'chef de projet'
        ],
        [
            'name' => 'Directeur'
        ],
        [
            'name' => 'Chargée de clientèle'
        ],
        [
            'name' => 'Devéloppeur informatique'
        ],
        [
            'name' => 'Comptable'
        ],
        [
            'name' => 'Informaticien'
        ],
        [
            'name' => 'Président'
        ],
        [
            'name' => 'Responsable des ventes'
        ],
        [
            'name' => 'Responsable du personnel'
        ],
        [
            'name' => 'Responsable marketing'
        ]
    ];

    // TODO: entreprise vision aditionnel (manana super admin)
    public function load(ObjectManager $manager)
    {
        $company = (new Company())
            ->setName(self::$company['name'])
            ->setLogo(self::$company['logo'])
            ->setLegalStructure(self::$company['legalStructure'])
            ->setSocialReason(self::$company['socialReason'])
            ->setCreatedAt(new \DateTime(self::$company['createdAt']))
            ->setSales(self::$company['sales'])
            ->setAddress(self::$company['address'])
            ->setPostalCode(self::$company['postalCode'])
            ->setCity(self::$company['city'])
            ->setSite(self::$company['site'])
            ->setPhoneNumber(self::$company['phoneNumber'])
            ->setLeadingStatus(self::$company['leadingStatus'])
            ->setSchedule(self::$company['schedule'])
            ->setAssignment(self::$company['assignment'])
        ;

        $manager->persist($company);
        $this->addIdentificationCompany($company, $manager);
        $manager->flush();
        $this->addUser($company, $manager);
        $this->addFunctions($company, $manager);
    }

    private function addIdentificationCompany(Company $company, ObjectManager $manager): void
    {
        $identification = $company->getIdentification();
        $identification
            ->setSiren(self::$company['siren'])
            ->setSiret(self::$company['siret'])
            ->setTva(self::$company['tva'])
            ->setRcs(self::$company['rcs'])
            ->setSector(self::$company['sector'])
            ->setCode(self::$company['code'])
            ->setDetails(self::$company['details'])
            ->setIdcc(self::$company['idcc'])
            ->setProvisioning(self::$company['provisioning'])
            ->setHealthComplementary(self::$company['healthComplementary'])
            ->setPensionFund(self::$company['pensionFund'])
        ;

        $manager->persist($identification);
        $company->setIdentification($identification);
        $manager->persist($company);
    }

    private function addUser(Company $company, ObjectManager $manager): void
    {
        foreach (self::$users as $value) {
            $user = new User();
            $user->setEmail($value['email']);
            $password = $this->hasher->hashPassword($user, $value['password']);
            $user->setPassword($password);
            $user->setResponsibility($value['responsibility']);
            $user->setSex($value['sex']);
            $user->setRoles($value['roles']);
            $user->setCompany($company);

            if ('supadmin@test.com' === $value['email']) {
                $company->setProperty($user);
            }

            $user->setSalary(new Salary());
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function addFunctions(Company $company, ObjectManager $manager): void
    {
        foreach(self::$functions as $function) {
            $objet = (new Functions())
                ->setName($function['name']);
            $manager->persist($objet);
            $objet->setCompany($company);
        }

        $manager->flush();
    }
}
