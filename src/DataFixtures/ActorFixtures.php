<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        // $product = new Product();
        // $manager->persist($product);
        $nbProgram = count(ProgramFixtures::PROGRAMS);
        for ($i = 0; $i < 10; $i++) {
                $actor = new Actor();
                $actor->setFirstname($faker->firstName());
                $actor->setLastname($faker->lastName());
                $actor->setBirthDate($faker->dateTimeBetween('-80 years', '-17 years'));
                for ($j = 0; $j < 3; $j++) {
                $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1,$nbProgram -1)));
                }
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
