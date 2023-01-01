<?php

namespace App\DataFixtures;

use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMS = [
        ['Title' => 'Walking dead', 'Synopsis' => "Des zombies envahissent la terre", 'Poster' => 'https://www.lexpress.fr/resizer/grNyZAK7cz7rclhD3JZsdXmaH_k=/1200x630/cloudfront-eu-central-1.images.arcpublishing.com/lexpress/NONRBXY4SJFRZDP4WJOAKOYZYY.jpg', 'Category' => 'category_Action',],
        ['Title' => 'Malcom', 'Synopsis' => "Petit génie malgré lui, Malcolm vit dans une famille hors du commun. Le jeune surdoué n'hésite pas à se servir de son intelligence pour faire les 400 coups avec ses frères.", 'Poster' => 'https://www.nextplz.fr/wp-content/uploads/nextplz/2020/08/malcolm-famille-saison-5-ciel-palissade.jpg', 'Category' => 'category_Comédie',],
        ['Title' => 'Sex Education', 'Synopsis' => "La rebelle Maeve entraîne Otis, un ado vierge mais dont la mère est sexologue, dans la création d'une cellule de thérapie sexuelle clandestine au sein de leur lycée.", 'Poster' => 'https://nousvospapiers.files.wordpress.com/2019/01/sex-education.jpg?w=726', 'Category' => "category_Feel good",],
        ['Title' => 'Colin en noir et blanc', 'Synopsis' => "Le parcours de l'ancien joueur de la NFL Colin Kaepernick à travers les obstacles que constituent la différence de couleur, de classe et de culture pour un jeune garçon noir adopté par une famille blanche.", 'Poster' => 'https://occ-0-2995-55.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABfR7EN569SwCodeXyxSlwAAswRLGTWMVkhErk10hLjzqMJH2hR9lgWnX6MaxRoISh0XDFAF0Xeq0_n9DbDJuUBBcIRMD-jpEziu9BBBbSlQQM8FFBzlKR6d1pbdTFSDl5VSKww.jpg?r=0f8', 'Category' => "category_Documentaire",],
        ['Title' => 'Black Mirror', 'Synopsis' => "Chaque épisode a un casting différent, un décor différent et une réalité différente, mais ils traitent tous de la façon dont nous vivons maintenant, et de la façon dont nous pourrions vivre dans dix minutes si nous sommes maladroits.", 'Poster' => 'https://img.nrj.fr/VCdMWgPk2YcXDDrw2yx4awUBRA4=/0x415/smart/medias%2F2022%2F07%2F62d6680cba380_62d668164ba7c.jpg', 'Category' => "category_Horreur",],
        ['Title' => 'Squid Game', 'Synopsis' => "Des personnes en difficultés financières sont invitées à une mystérieuse compétition de survie. Participant à une série de jeux traditionnels pour enfants, mais avec des rebondissements mortels, elles risquent leur vie pour une grosse somme d'argent.", 'Poster' => 'https://images.theconversation.com/files/426958/original/file-20211018-57123-1mrj2of.jpg?ixlib=rb-1.1.0&rect=274%2C0%2C1633%2C1206&q=45&auto=format&w=926&fit=clip', 'Category' => "category_Horreur",],
        ['Title' => 'All Of Us Are Dead', 'Synopsis' => "Un virus zombie se répand rapidement dans une école. Les élèves en danger luttent pour survivre et s'échapper.", 'Poster' => 'https://imgsrc.cineserie.com/2022/06/1915442.jpg?ver=1', 'Category' => "category_Horreur",],
        ['Title' => 'Slasher', 'Synopsis' => "D'ignobles tueurs en série sèment l'effroi tandis que leurs prochaines victimes luttent pour leur survie dans cette terrifiante série d'anthologie.", 'Poster' => 'https://upload.wikimedia.org/wikipedia/commons/d/d2/Slasher_TV_logo.png', 'Category' => "category_Horreur",],
        ['Title' => 'My name is Earl', 'Synopsis' => "Earl J. Hickey est une crapule de petite envergure qui, après avoir gagné 100 000 dollars à un jeu de grattage et les avoir perdus immédiatement en se faisant renverser par une voiture, décide de réparer tout le mal qu'il a fait au cours de sa vie.", 'Poster' => 'https://flxt.tmsimg.com/assets/p185093_b_h9_aa.jpg', 'Category' => 'category_Comédie',],
        ['Title' => 'FRIENDS', 'Synopsis' => "Les péripéties de trois jeunes femmes et trois jeunes hommes new-yorkais liés par une profonde amitié. Entre amour, travail, famille, ils partagent leurs bonheurs et leurs soucis au Central Perk, leur café favori.", 'Poster' => 'https://media.vanityfair.fr/photos/614b033a3657cac85cbb2b02/3:2/w_2009,h_1340,c_limit/Jon%20Ragel%20:%C2%A9%20NBC%20:%20Courtesy%20Everett%20Collection.jpg', 'Category' => 'category_Comédie',],
        ['Title' => 'Atypical', 'Synopsis' => "Sam, un jeune adolescent autiste, se met en quête d'une histoire romantique et d'indépendance. Sa volonté de trouver l'amour sera un véritable tournant dans la vie de sa mère.", 'Poster' => 'https://squared-potato.pt/wp-content/uploads/2021/07/atypical.jpg', 'Category' => 'category_Comédie',],
        ['Title' => 'Please like me', 'Synopsis' => "Après avoir été abandonné par sa petite amie, Josh commence à réaliser qu'il est réellement attiré par les hommes. Pour quelqu'un comme lui ayant une tendance au drame, ces défis seront particulièrement difficiles.", 'Poster' => 'https://cdn.gonzague.me/wp-content/uploads/2017/08/Please-Like-Me-Serie.jpg', 'Category' => 'category_Comédie',],
        ['Title' => 'Britney VS Spears', 'Synopsis' => "Traduit de l'anglais-Britney vs Spears est un film documentaire américain de 2021 réalisé par Erin Lee Carr, qui suit l'auteure-compositrice-interprète américaine Britney Spears et sa vie sur plusieurs années de sa carrière et de sa tutelle.", 'Poster' => 'https://cache.cosmopolitan.fr/data/photo/w1000_ci/5h/britney-spears.jpg', 'Category' => 'category_Documentaire',],
        ['Title' => 'Coach Snoop', 'Synopsis' => "Snoop Dogg quitte le studio d'enregistrement pour entraîner une équipe d'adolescents au sein de la Snoop Youth Football League. Snoop et ses joueurs participent à un championnat tout en faisant face à l'adversité en dehors du terrain.", 'Poster' => 'https://occ-0-769-1217.1.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABbok-lF5LCtU96cM7ZzZX0gW_f8dA09enaeQNvKJuHwEAkZXImhdkeso-QSs-g2jw9dkOEA2HE8zKZnseT7TMNvIpiLIZtNskdcm1W2t2xKynOnXFRADwqTv5MgtPrz8Zg4Qsg.jpg?r=ab8', 'Category' => 'category_Documentaire',],
        ['Title' => 'Woodstock 99', 'Synopsis' => "Dans un champ du comté de Bethel, au nord de l'État de New York, une scène de concert se construit sous nos yeux, et la musique, au même moment, envahit nos tympans. Jusqu'à la clôture du festival, et après trois jours `de paix et d'amour', elle sera le fil conducteur du film.", 'Poster' => 'https://occ-0-586-114.1.nflxso.net/dnm/api/v6/6AYY37jfdO6hpXcMjf9Yu5cnmO0/AAAABRFfxGhTAYFicPp82tNCb7zpQ-BVaIyAP-OGsy8Wib6WwIxF97WMJjd3IaUjUN3ij2PKo69XNUKzbmsS3upm_73q3Cfmdn4tSH2g.jpg?r=3d2', 'Category' => 'category_Documentaire',],
        ['Title' => 'Le dernier Vol de la navette Challenger', 'Synopsis' => "La navette Challenger a connu neuf décollages et atterrissages avant de se désintégrer lors du vol datant du 28 janvier 1986, entraînant la mort des membres de son équipage, dont une civile.", 'Poster' => 'https://occ-0-1001-2774.1.nflxso.net/dnm/api/v6/9pS1daC2n6UGc3dUogvWIPMR_OU/AAAABebOYVBh9lCxnyq17ofD2PzvNNJ7-TlBMs3Xo-5AUOfBY2sUvpGQvz-z_GeudZf2VwFCcIA3YAL3inMYEW3U1S7TXX-UBdwm6n5ZqtnXHGhNL4negcYJGKcB.jpg?r=9d1', 'Category' => 'category_Documentaire',],
        ['Title' => 'New girl', 'Synopsis' => "A Los Angeles, suite à une rupture, Jess a déniché un appartement sur Internet, qu'elle partage en colocation avec trois hommes. Nick, un barman, Schmidt, un employé particulièrement séducteur, et Winston, un ancien joueur de basket-ball.", 'Poster' => 'https://img.nrj.fr/HTy2Yn3dVyPLuqM3I7gFiKSi7Ms=/0x415/smart/medias%2F2022%2F02%2F61fa65676fbf5_61fa656d637bb.jpg', 'Category' => "category_Feel good",],
        ['Title' => 'Emily in Paris', 'Synopsis' => "Emily Cooper, jeune directrice marketing à Chicago, est engagée dans une célèbre agence de marketing parisienne afin de mettre sa perspective américaine au service de ses futurs clients.", 'Poster' => 'https://occ.a.nflxso.net/dnm/api/v6/6gmvu2hxdfnQ55LZZjyzYR4kzGk/AAAABfUtkZIHOTjMigqFP-oaDJmu3CdsnEqo_ooUY3Io41-Jr0AUN1Q1aOdIPANOI4Jvw0irwaddgPvFXYLbwCNSsHkNSq3TQoX6hznPuzwf5Cln-8UktCDavNJO-_MOu23nPM1reQ.jpg?r=77c', 'Category' => "category_Feel good",],
        ['Title' => 'Love', 'Synopsis' => "Gus rencontre une femme de nature complètement opposée à la sienne, qui est calme et conciliante. Lorsqu'ils tombent amoureux l'un de l'autre, le chaos et le stress relationnel deviennent les compagnons quotidiens de leur vie.", 'Poster' => 'https://www.telerama.fr/sites/tr_master/files/styles/simplecrop1000/public/medias/2016/01/media_137146/love-la-serie-de-netflix-qui-aime-l-amour-qui-se-fait-mal%2CM295362.jpg?itok=cf8SrgHl', 'Category' => "category_Feel good",],
        ['Title' => 'Absolutly Fabulous', 'Synopsis' => "Edina, mère de famille à la fois à la tête d'une société de relations publiques, ainsi que Patsy, une rédactrice de mode avec une morale douteuse, sont des femmes plongées dans l'alcool, la drogue et le scandale du monde de la mode à Londres.", 'Poster' => 'https://flxt.tmsimg.com/assets/p7895855_b_h10_ab.jpg', 'Category' => "category_Feel good",],
        ['Title' => 'How I Met Your Mother', 'Synopsis' => "La série débute en 2030, lorsque Ted Mosby raconte à ses deux enfants comment il a rencontré leur mère. Il se remémore ses jeunes années, et le pilote fait place aux souvenirs de Ted en 2005, où il apprend que son meilleur ami Marshall Eriksen va demander à Lily Aldrin de l'épouser. Ted se demande quand il rencontrera sa future épouse. Et c'est ainsi que commence l'incroyable et très longue histoire de Ted, jusqu'à sa rencontre avec la fameuse mère.", 'Poster' => 'https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/BEA544D7476F6C33E23CB73494F462BAF5F9A247B41B335F74094773F4112C03/scale?width=1200&aspectRatio=1.78&format=jpeg', 'Category' => "category_Feel good",],
        ['Title' => 'Hannibal', 'Synopsis' => "Jack Crawford recrute un profiler qui possède un don lui permettant d'aider à la capture de tueurs.", 'Poster' => 'https://imgsrc.cineserie.com/2020/11/hannibal-saison-4-mads-mikkelsen-a-une-idee-pour-la-suite-1.jpg?ver=1', 'Category' => "category_Horreur",],
        ['Title' => 'The Mandalorian', 'Synopsis' => "Un tireur solitaire voyage dans les contrées les plus reculées de la galaxie, loin du joug de la Nouvelle République.", 'Potser' => 'https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/1C42324412D81E612EFD8E9DAB82B24EB43D057306A3F812214E9BA728DC0162/scale?width=1200&aspectRatio=1.78&format=jpeg', 'Category' => "category_Action",],
        ['Title' => 'Le Livre de Boba Fett', 'Synopsis' => "Spin-off de The Mandalorian centré sur les aventures du chasseur de primes Boba Fett et de la mercenaire Fennec Shand. Tous deux reviennent sur Tatooine pour y revendiquer le territoire autrefois dirigé par Jabba le Hutt.", 'Poster' => 'https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/29C13A9399356588F41668D679DF3C5D2A58D2ED302C0E3BD2BDDACC5C657F79/scale?width=1200&aspectRatio=1.78&format=jpeg', 'Category' => "category_Action",],
        ['Title' => 'Obi-Wan Kenobi', 'Synopsis' => "Le Maître Jedi fait face aux conséquences de sa plus grande défaite: la chute et la corruption de son ancien ami et apprenti, Anakin Skywalker, qui s'est tourné vers le côté obscur en tant que Dark Vador.", 'Poster' => 'https://www.tomsguide.fr/content/uploads/sites/2/2021/06/obi-wan.jpg', 'Category' => "category_Action",],
        ['Title' => 'Le bureau des légendes', 'Synopsis' => "Des agents du renseignement extérieur français sont en immersion à l'étranger. Leur mission est de repérer les personnes susceptibles d'être recrutées comme sources de renseignements.", 'Poster' => 'https://www.croix-rouge.fr/var/crf_internet/storage/images/accueil/la-croix-rouge/droit-international-humanitaire/diffuser-le-dih/le-bureau-des-legendes-legende-par-le-droit-international-humanitaire/21794905-1-fre-FR/Le-Bureau-des-legendes-legende-par-le-droit-international-humanitaire_articleimagelargeur.jpg', 'Category' => "category_Action",],
        ['Title' => 'Braquo', 'Synopsis' => "Suite à la condamnation injuste et au suicide de leur chef de groupe, trois policiers de la police judiciaire ont la tentation de franchir la ligne rouge. Faisant ainsi front à la machine administrative qui a conduit leur ami jusqu'à la mort.", 'Poster' => 'https://resize-lejdd.lanmedia.fr/var/jdd/public/media/image/2022/07/20/18/braquo-emmy-award-de-la-meilleure-serie-dramatique.jpg?VersionId=Cx6vM6D6NBofmMw_kqSddLqmoqclmGSH', 'Category' => "category_Action",],
    ];
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {

        foreach (self::PROGRAMS as $key => $tvshow) {

            $program = new Program();
            $program->setTitle($tvshow['Title']);
            $program->setSynopsis($tvshow['Synopsis']);
            $program->setPoster($tvshow['Poster']);
            $program->setCategory($this->getReference($tvshow['Category']));
            $slug = $this->slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $this->addReference('program_' . $key, $program);
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }

}


