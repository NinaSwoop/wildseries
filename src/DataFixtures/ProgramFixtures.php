<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMS = [
        ['Title' => 'Walking dead', 'Synopsis' => "Des zombies envahissent la terre", 'Category' => 'category_Action',],
        ['Title' => 'Malcom', 'Synopsis' => "Petit génie malgré lui, Malcolm vit dans une famille hors du commun. Le jeune surdoué n'hésite pas à se servir de son intelligence pour faire les 400 coups avec ses frères.", 'Category' => 'category_Comédie',],
        ['Title' => 'Sex Education', 'Synopsis' => "La rebelle Maeve entraîne Otis, un ado vierge mais dont la mère est sexologue, dans la création d'une cellule de thérapie sexuelle clandestine au sein de leur lycée.", 'Category' => "category_Feel good",],
        ['Title' => 'Colin en noir et blanc', 'Synopsis' => "Le parcours de l'ancien joueur de la NFL Colin Kaepernick à travers les obstacles que constituent la différence de couleur, de classe et de culture pour un jeune garçon noir adopté par une famille blanche.", 'Category' => "category_Documentaire",],
        ['Title' => 'Black Mirror', 'Synopsis' => "Chaque épisode a un casting différent, un décor différent et une réalité différente, mais ils traitent tous de la façon dont nous vivons maintenant, et de la façon dont nous pourrions vivre dans dix minutes si nous sommes maladroits.", 'Category' => "category_Horreur",],
        ['Title' => 'Squid Game', 'Synopsis' => "Des personnes en difficultés financières sont invitées à une mystérieuse compétition de survie. Participant à une série de jeux traditionnels pour enfants, mais avec des rebondissements mortels, elles risquent leur vie pour une grosse somme d'argent.", 'Category' => "category_Horreur",],
        ['Title' => 'All Of Us Are Dead', 'Synopsis' => "Un virus zombie se répand rapidement dans une école. Les élèves en danger luttent pour survivre et s'échapper.", 'Category' => "category_Horreur",],
        ['Title' => 'Slasher', 'Synopsis' => "D'ignobles tueurs en série sèment l'effroi tandis que leurs prochaines victimes luttent pour leur survie dans cette terrifiante série d'anthologie.", 'Category' => "category_Horreur",],
        ['Title' => 'My name is Earl', 'Synopsis' => "Earl J. Hickey est une crapule de petite envergure qui, après avoir gagné 100 000 dollars à un jeu de grattage et les avoir perdus immédiatement en se faisant renverser par une voiture, décide de réparer tout le mal qu'il a fait au cours de sa vie.", 'Category' => 'category_Comédie',],
        ['Title' => 'FRIENDS', 'Synopsis' => "Les péripéties de trois jeunes femmes et trois jeunes hommes new-yorkais liés par une profonde amitié. Entre amour, travail, famille, ils partagent leurs bonheurs et leurs soucis au Central Perk, leur café favori.", 'Category' => 'category_Comédie',],
        ['Title' => 'Atypical', 'Synopsis' => "Sam, un jeune adolescent autiste, se met en quête d'une histoire romantique et d'indépendance. Sa volonté de trouver l'amour sera un véritable tournant dans la vie de sa mère.", 'Category' => 'category_Comédie',],
        ['Title' => 'Please like me', 'Synopsis' => "Après avoir été abandonné par sa petite amie, Josh commence à réaliser qu'il est réellement attiré par les hommes. Pour quelqu'un comme lui ayant une tendance au drame, ces défis seront particulièrement difficiles.", 'Category' => 'category_Comédie',],
        ['Title' => 'Britney VS Spears', 'Synopsis' => "Traduit de l'anglais-Britney vs Spears est un film documentaire américain de 2021 réalisé par Erin Lee Carr, qui suit l'auteure-compositrice-interprète américaine Britney Spears et sa vie sur plusieurs années de sa carrière et de sa tutelle.", 'Category' => 'category_Documentaire',],
        ['Title' => 'Coach Snoop', 'Synopsis' => "Snoop Dogg quitte le studio d'enregistrement pour entraîner une équipe d'adolescents au sein de la Snoop Youth Football League. Snoop et ses joueurs participent à un championnat tout en faisant face à l'adversité en dehors du terrain.", 'Category' => 'category_Documentaire',],
        ['Title' => 'Woodstock 99', 'Synopsis' => "Dans un champ du comté de Bethel, au nord de l'État de New York, une scène de concert se construit sous nos yeux, et la musique, au même moment, envahit nos tympans. Jusqu'à la clôture du festival, et après trois jours `de paix et d'amour', elle sera le fil conducteur du film.", 'Category' => 'category_Documentaire',],
        ['Title' => 'Le dernier Vol de la navette Challenger', 'Synopsis' => "La navette Challenger a connu neuf décollages et atterrissages avant de se désintégrer lors du vol datant du 28 janvier 1986, entraînant la mort des membres de son équipage, dont une civile.", 'Category' => 'category_Documentaire',],
        ['Title' => 'New girl', 'Synopsis' => "A Los Angeles, suite à une rupture, Jess a déniché un appartement sur Internet, qu'elle partage en colocation avec trois hommes. Nick, un barman, Schmidt, un employé particulièrement séducteur, et Winston, un ancien joueur de basket-ball.", 'Category' => "category_Feel good",],
        ['Title' => 'Emily in Paris', 'Synopsis' => "Emily Cooper, jeune directrice marketing à Chicago, est engagée dans une célèbre agence de marketing parisienne afin de mettre sa perspective américaine au service de ses futurs clients.", 'Category' => "category_Feel good",],
        ['Title' => 'Love', 'Synopsis' => "Gus rencontre une femme de nature complètement opposée à la sienne, qui est calme et conciliante. Lorsqu'ils tombent amoureux l'un de l'autre, le chaos et le stress relationnel deviennent les compagnons quotidiens de leur vie.", 'Category' => "category_Feel good",],
        ['Title' => 'Absolutly Fabulous', 'Synopsis' => "Edina, mère de famille à la fois à la tête d'une société de relations publiques, ainsi que Patsy, une rédactrice de mode avec une morale douteuse, sont des femmes plongées dans l'alcool, la drogue et le scandale du monde de la mode à Londres.", 'Category' => "category_Feel good",],
        ['Title' => 'How I Met Your Mother', 'Synopsis' => "La série débute en 2030, lorsque Ted Mosby raconte à ses deux enfants comment il a rencontré leur mère. Il se remémore ses jeunes années, et le pilote fait place aux souvenirs de Ted en 2005, où il apprend que son meilleur ami Marshall Eriksen va demander à Lily Aldrin de l'épouser. Ted se demande quand il rencontrera sa future épouse. Et c'est ainsi que commence l'incroyable et très longue histoire de Ted, jusqu'à sa rencontre avec la fameuse mère.", 'Category' => "category_Feel good",],
        ['Title' => 'Hannibal', 'Synopsis' => "Jack Crawford recrute un profiler qui possède un don lui permettant d'aider à la capture de tueurs.", 'Category' => "category_Horreur",],
        ['Title' => 'The Mandalorian', 'Synopsis' => "Un tireur solitaire voyage dans les contrées les plus reculées de la galaxie, loin du joug de la Nouvelle République.", 'Category' => "category_Action",],
        ['Title' => 'Le Livre de Boba Fett', 'Synopsis' => "Spin-off de The Mandalorian centré sur les aventures du chasseur de primes Boba Fett et de la mercenaire Fennec Shand. Tous deux reviennent sur Tatooine pour y revendiquer le territoire autrefois dirigé par Jabba le Hutt.", 'Category' => "category_Action",],
        ['Title' => 'Obi-Wan Kenobi', 'Synopsis' => "Le Maître Jedi fait face aux conséquences de sa plus grande défaite: la chute et la corruption de son ancien ami et apprenti, Anakin Skywalker, qui s'est tourné vers le côté obscur en tant que Dark Vador.", 'Category' => "category_Action",],
        ['Title' => 'Le bureau des légendes', 'Synopsis' => "Des agents du renseignement extérieur français sont en immersion à l'étranger. Leur mission est de repérer les personnes susceptibles d'être recrutées comme sources de renseignements.", 'Category' => "category_Action",],
        ['Title' => 'Braquo', 'Synopsis' => "Suite à la condamnation injuste et au suicide de leur chef de groupe, trois policiers de la police judiciaire ont la tentation de franchir la ligne rouge. Faisant ainsi front à la machine administrative qui a conduit leur ami jusqu'à la mort.", 'Category' => "category_Action",],
    ];



    public function load(ObjectManager $manager)
    {

        foreach (self::PROGRAMS as $key => $tvshow) {
            $program = new Program();
            $program->setTitle($tvshow['Title']);
            $program->setSynopsis($tvshow['Synopsis']);
            $program->setCategory($this->getReference($tvshow['Category']));
            $manager->persist($program);
            // $setcover
            $manager->flush();
        }
    }
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            //FQCN nom de la classe avec son namespace. C'est ce dont à besoin symfony pour connaître les fixtures 
            //regarder lazyloading
        ];
    }
}
