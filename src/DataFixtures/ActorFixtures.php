<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        ['firstname' => 'Zooey', 'lastname' => "Deschanel", 'birth_date' => '',],
        ['firstname' => 'AAron', 'lastname' => "Paul", 'birth_date' => '',],
        ['firstname' => 'Bryan', 'lastname' => "Cranston", 'birth_date' => '',],
        ['firstname' => 'Frankie', 'lastname' => "Muniz", 'birth_date' => '',],
        ['firstname' => 'Jake', 'lastname' => "Johnson", 'birth_date' => '',],
        ['firstname' => 'Hannah', 'lastname' => "Simone", 'birth_date' => '',],
        ['firstname' => 'Emma', 'lastname' => "Mackey", 'birth_date' => '',],
        ['firstname' => 'Asa', 'lastname' => "Butterfield", 'birth_date' => '',],
        ['firstname' => 'Gillian', 'lastname' => "Anderson", 'birth_date' => '',],
        ['firstname' => 'Gillian', 'lastname' => "Jacobs", 'birth_date' => '',],
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (self::ACTORS as $key => $value) {
            $actor = new Actor();
            $actor->setFirstname((self::ACTORS[$key]['firstname']));
            $actor->setLastname((self::ACTORS[$key]['lastname']));
            $actor->setBirthDate($faker->dateTimeBetween('-80 years', '-17 years'));
            $manager->persist($actor);
        }
        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
