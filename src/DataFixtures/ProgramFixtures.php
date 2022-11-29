<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSynopsis('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Malcom');
        $program->setSynopsis("Petit génie malgré lui, Malcolm vit dans une famille hors du commun. Le jeune surdoué n'hésite pas à se servir de son intelligence pour faire les 400 coups avec ses frères.");
        $program->setCategory($this->getReference('category_Comédie'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Sex Education');
        $program->setSynopsis("La rebelle Maeve entraîne Otis, un ado vierge mais dont la mère est sexologue, dans la création d'une cellule de thérapie sexuelle clandestine au sein de leur lycée.");
        $program->setCategory($this->getReference("category_Feel good"));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Colin en noir et blanc');
        $program->setSynopsis("Le parcours de l'ancien joueur de la NFL Colin Kaepernick à travers les obstacles que constituent la différence de couleur, de classe et de culture pour un jeune garçon noir adopté par une famille blanche.");
        $program->setCategory($this->getReference('category_Documentaire'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Black Mirror');
        $program->setSynopsis("Chaque épisode a un casting différent, un décor différent et une réalité différente, mais ils traitent tous de la façon dont nous vivons maintenant, et de la façon dont nous pourrions vivre dans dix minutes si nous sommes maladroits.");
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
