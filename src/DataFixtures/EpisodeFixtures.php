<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        /**
         * L'objet $faker que tu récupère est l'outil qui va te permettre
         * de te générer toutes les données que tu souhaites
         */

        // boucle sur program 
        for ($i = 0; $i < 26; $i++) {
            // boucle season 
            for ($j = 1; $j < 6; $j++) {
                // boucle episode
                for ($k = 1; $k < 11; $k++) {

                    
                    $episode = new Episode();
                    //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                    $episode->setNumber($k);
                    $episode->setTitle($faker->words(3, true));
                    $episode->setSynopsis($faker->paragraphs(3, true));
                    $episode->setDuration($faker->numberBetween(60, 320));
                    $episode->setSeason($this->getReference('program_' . $i . '_season_' . $j));
                    $manager->persist($episode);
                }
            }
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
