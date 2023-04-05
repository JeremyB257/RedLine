<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\Order;
use App\Entity\OrderItems;
use App\Entity\Product;
use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setFirstname('Laxar');
        $user->setEmail('laxar@laxar.com');
        $user->setPassword($this->hasher->hashPassword($user, 'password'));
        $user->setRoles(['ROLE_USER','ROLE_ADMIN']);
        $user->setNewsletter(true);
        $user->setActive(true);
        $manager->persist($user);

        $faker = Factory::create('fr_FR');

        $users = [$user];

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstname());
            $user->setEmail($faker->safeEmail());
            $user->setPassword($this->hasher->hashPassword($user, $faker->password()));
            $user->setNewsletter(true);
            $user->setActive(true);
            $manager->persist($user);
            $users[] = $user;
        }

        $slugger = new AsciiSlugger();

        $watches = [];
        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('GMT-Master II')
            ->setImgUrl('RolexGmtMaster-green.png,RolexGmtMaster-red.png,RolexGmtMaster-blue.png,RolexBoite.png')
            ->setPriceHt(12000)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
            ->setCategory('homme')
            ->setColor('green,red,blue')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La Rolex GMT-Master II est une montre pour homme conçue pour les voyageurs. Le boîtier en acier inoxydable mesure 40 mm de diamètre et est équipé d'une lunette bidirectionnelle en céramique. La montre dispose d'un affichage de l'heure GMT et d'un affichage de la date à 3 heures. Elle est étanche jusqu'à 100 mètres et dispose d'un bracelet en acier inoxydable confortable.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Oyster Perpetual')
            ->setImgUrl('RolexOysterPerpetual-green.png,RolexOysterPerpetual-blue.png,RolexOysterPerpetual-red.png,RolexBoite.png')
            ->setPriceHt(8500)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(41)
            ->setCategory('homme')
            ->setColor('green,blue,red')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La Rolex Submariner est une montre de plongée emblématique pour homme. Le boîtier en acier inoxydable mesure 41 mm de diamètre et est équipé d'une lunette tournante unidirectionnelle. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 300 mètres. Le bracelet en acier inoxydable est à la fois robuste et élégant.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Sea Dweller')
            ->setImgUrl('RolexSeaDweller-black.png,RolexSeaDweller-red.png,RolexSeaDweller-blue.png,RolexBoite.png')
            ->setPriceHt(9500)
            ->setMaterial('or')
            ->setMovement('Automatique')
            ->setCaseDiameter(41)
            ->setCategory('homme')
            ->setColor('black,red,blue')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La Rolex Datejust pour homme est une montre élégante et intemporelle. Le boîtier en acier inoxydable et or jaune mesure 41 mm de diamètre et offre un design classique. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 100 mètres. Le bracelet en acier inoxydable et or jaune ajoute une touche de sophistication à l'ensemble.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Daytona')
            ->setImgUrl('RolexDaytona-white.png,RolexDaytona-yellow.png,RolexBoite.png')
            ->setPriceHt(13000)
            ->setMaterial('or')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('white,yellow')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La Rolex Daytona est une montre de sport de luxe pour homme. Le boîtier en or jaune 18 carats mesure 40 mm de diamètre et offre un design élégant et classique. La montre dispose d'un chronographe et est étanche jusqu'à 100 mètres. Le bracelet en or jaune 18 carats complète parfaitement l'ensemble.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Explorer')
            ->setImgUrl('RolexExplorer-purple.png,RolexExplorer-black.png,RolexBoite.png')
            ->setPriceHt(6600)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(39)
            ->setCategory('femme')
            ->setColor('black,purple')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("La Rolex Explorer est une montre de sport pour homme. Le boîtier en acier inoxydable mesure 39 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose d'un affichage de la date à 3 heures et d'aiguilles luminescentes pour une visibilité accrue dans l'obscurité. Le bracelet en acier inoxydable est à la fois robuste et élégant.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Day-Date')
            ->setImgUrl('RolexDaydate-green.png,RolexDaydate-blue.png,RolexBoite.png')
            ->setPriceHt(33500)
            ->setMaterial('or')
            ->setMovement('Automatique')
            ->setCaseDiameter(36)
            ->setCategory('homme')
            ->setColor('blue,green')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La Rolex Day-Date est une montre de luxe pour homme en or jaune 18 carats. Le boîtier mesure 36 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose d'un affichage de la date à 3 heures et d'un affichage du jour de la semaine en toutes lettres à 12 heures. Le bracelet en or jaune 18 carats est à la fois élégant et confortable.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Air-King')
            ->setImgUrl('RolexAirKing-black.png,RolexBoite.png')
            ->setPriceHt(6100)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(42)
            ->setCategory('homme')
            ->setColor('black')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La Rolex Air-King est une montre pour homme inspirée par les pionniers de l'aviation. Le boîtier en acier Oystersteel mesure 40 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose d'un design épuré et élégant, sans fonctionnalités spécifiques. Le mouvement automatique offre une grande précision et une autonomie longue durée.");
        $manager->persist($watch);
        $watches[] = $watch;


        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Prospex')
            ->setImgUrl('SeikoProspex-black.png,SeikoProspex-blue.png,SeikoProspex-green.png')
            ->setPriceHt(400)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
            ->setCategory('homme')
            ->setColor('black,blue,green')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription('Découvrez la montre Seiko Prospex pour homme. Cette montre sportive automatique est conçue pour les plongeurs professionnels. Son boîtier en acier inoxydable résistant mesure 44 mm de diamètre et offre une étanchéité de 200 mètres. La lunette tournante unidirectionnelle permet de mesurer le temps de plongée avec précision. La montre dispose également d\'un affichage de la date et d\'un bracelet en acier inoxydable.');
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Presage')
            ->setImgUrl('SeikoPresage-blue.png')
            ->setPriceHt(900)
            ->setMaterial('cuir')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('blue')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(50)
            ->setDescription('La montre Seiko Presage pour homme est une montre automatique élégante et raffinée. Son boîtier en acier inoxydable mesure 40,5 mm de diamètre et son bracelet en cuir noir apporte une touche de sophistication. La montre dispose d\'un affichage de la date à 3 heures et est étanche jusqu\'à 50 mètres. La montre Presage est un choix parfait pour les occasions formelles et les événements spéciaux.');
        $manager->persist($watch);
        $watches[] = $watch;


        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('5 Sports')
            ->setImgUrl('SeikoSport-black.png,SeikoSport-blue.png')
            ->setPriceHt(200)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(42)
            ->setCategory('homme')
            ->setColor('black,blue')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription('Découvrez la montre Seiko 5 Sports pour homme. Cette montre automatique est conçue pour les activités sportives et de plein air. Son boîtier en acier inoxydable mesure 42,5 mm de diamètre et offre une étanchéité de 100 mètres. La lunette tournante unidirectionnelle permet de mesurer le temps écoulé avec précision. La montre dispose également d\'un affichage de la date et d\'un bracelet en acier inoxydable. La montre Seiko 5 Sports est un choix parfait pour les aventuriers et les sportifs.');
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Diver')
            ->setImgUrl('SeikoDiver-red.png,SeikoDiver-green.png,SeikoDiver-blue.png')
            ->setPriceHt(300)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(38)
            ->setCategory('femme')
            ->setColor('red,green,blue')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La montre Seiko Prospex Diver pour homme est une montre automatique conçue pour les plongeurs. Son boîtier en acier inoxydable mesure 42 mm de diamètre et offre une étanchéité de 200 mètres. La montre dispose d'une lunette tournante unidirectionnelle pour mesurer le temps de plongée et d'un affichage de la date à 3 heures. Le bracelet en caoutchouc noir assure un bon maintien sur le poignet, même sous l'eau.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Cocktail Time')
            ->setImgUrl('SeikoCocktail-orange.png')
            ->setPriceHt(500)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('orange')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(50)
            ->setDescription("La montre Seiko Cocktail Time pour homme est une montre élégante et raffinée conçue pour les amateurs de cocktails. Son boîtier en acier inoxydable mesure 40,5 mm de diamètre et son cadran vert bouteille est orné d'un motif de soleil rayonnant. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 50 mètres. La montre Presage Cocktail Time est un choix parfait pour les soirées chics et les dîners entre amis.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Queen')
            ->setImgUrl('SeikoQueen-red.png,SeikoQueen-brown.png,SeikoQueen-purple.png')
            ->setPriceHt(2200)
            ->setMaterial('titane')
            ->setMovement('Automatique')
            ->setCaseDiameter(37)
            ->setCategory('femme')
            ->setColor('red,brown,purple')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La montre Seiko Queen pour femme est une montre GPS solaire haut de gamme. Son boîtier en titane mesure 37 mm de diamètre et offre une étanchéité de 100 mètres. La montre est alimentée par l'énergie solaire et dispose d'une fonction GPS qui permet de régler automatiquement l'heure et la date en fonction de votre position géographique. La montre dispose également d'un affichage de la date et d'un bracelet en titane.");
        $manager->persist($watch);
        $watches[] = $watch;


        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Lukia')
            ->setImgUrl('SeikoLukia-green.png,SeikoLukia-white.png')
            ->setPriceHt(750)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(36)
            ->setCategory('femme')
            ->setColor('green,white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("Découvrez la montre Seiko Lukia pour femme. Cette montre automatique est conçue pour les aventuriers et les amateurs d'activités de plein air. Son boîtier en acier inoxydable mesure 40 mm de diamètre et offre une étanchéité de 200 mètres. La montre dispose d'un affichage de la date à 3 heures et d'une boussole sur le cadran pour vous orienter lors de vos sorties en montagne. Le bracelet en cuir marron apporte une touche de rusticité à cette montre sportive.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Alpinist')
            ->setImgUrl('SeikoAlpinist-green.png,SeikoAlpinist-brown.png')
            ->setPriceHt(1200)
            ->setMaterial('nylon')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
            ->setCategory('homme')
            ->setColor('green,brown')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(300)
            ->setDescription("La montre Seiko Alpinist pour homme est une montre de plongée haut de gamme. Son boîtier en titane mesure 44 mm de diamètre et offre une étanchéité de 300 mètres. La montre est équipée d'un mouvement automatique et dispose d'une fonction GMT pour afficher un second fuseau horaire. La date est affichée à 3 heures. Le bracelet en titane est confortable à porter, même lors de plongées prolongées. La montre Seiko Prospex est un choix parfait pour les plongeurs expérimentés et les amateurs de montres robustes.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Astron')
            ->setImgUrl('SeikoAstron-white.png,SeikoAstron-red.png')
            ->setPriceHt(500)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
            ->setCategory('homme')
            ->setColor('white,red')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La montre Seiko Astron pour homme est une montre automatique conçue pour les plongeurs. Son boîtier en acier inoxydable mesure 44 mm de diamètre et offre une étanchéité de 200 mètres. La montre dispose d'une lunette tournante unidirectionnelle pour mesurer le temps de plongée et d'un affichage de la date à 3 heures. Le bracelet en acier inoxydable assure un look robuste et sportif.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Classic')
            ->setImgUrl('SeikoClassic-green.png,SeikoClassic-white.png')
            ->setPriceHt(800)
            ->setMaterial('cuir')
            ->setMovement('Automatique')
            ->setCaseDiameter(41)
            ->setCategory('homme')
            ->setColor('green,white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(50)
            ->setDescription("La montre Seiko Classic pour homme est une montre élégante et fonctionnelle. Son boîtier en acier inoxydable mesure 40,5 mm de diamètre et son cadran bleu soleillé est orné de sous-cadrans pour le chronographe. La montre dispose d'une fonction chronographe pour mesurer le temps écoulé et d'un affichage de la date à 4 heures. La montre est étanche jusqu'à 50 mètres et dispose d'un bracelet en cuir noir. La montre Seiko Presage est un choix parfait pour les hommes élégants qui ont besoin d'une montre polyvalente pour leur vie quotidienne.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Le Locle')
            ->setImgUrl('TissotLocle-blue.png,TissotLocle-black.png,TissotLocle-white.png')
            ->setPriceHt(700)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(39)
            ->setCategory('femme')
            ->setColor('blue,black,white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("Découvrez la montre Tissot Le Locle pour homme. Cette montre automatique est un hommage à la ville suisse du même nom, berceau de l'horlogerie Tissot. Le boîtier en acier inoxydable mesure 39 mm de diamètre et offre un design élégant et classique. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 30 mètres. Le bracelet en acier inoxydable complète parfaitement l'ensemble.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('V8')
            ->setImgUrl('TissotV8-pink.png,TissotV8-white.png,TissotV8-black.png')
            ->setPriceHt(550)
            ->setMaterial('acier')
            ->setMovement('Quartz')
            ->setCaseDiameter(42)
            ->setCategory('femme')
            ->setColor('pink,white,black')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La montre Tissot V8 pour femme est une montre sportive et élégante. Le boîtier en acier inoxydable mesure 42,5 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose d'un chronographe et d'un affichage de la date à 4 heures. Le bracelet en acier inoxydable ajoute une touche de sophistication à l'ensemble.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Heritage Visodate')
            ->setImgUrl('TissotHeritageVisodate-blue.png,TissotHeritageVisodate-green.png,TissotHeritageVisodate-orange.png')
            ->setPriceHt(580)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(41)
            ->setCategory('homme')
            ->setColor('blue,green,orange')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(30)
            ->setDescription("La montre Tissot Heritage Visodate pour homme est un hommage aux montres Tissot classiques du passé. Le boîtier en acier inoxydable mesure 40 mm de diamètre et offre un design élégant et intemporel. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 30 mètres. Le bracelet en acier inoxydable complète parfaitement l'ensemble.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Seastar 1000 Powermatic 80')
            ->setImgUrl('TissotSeastar1000Powermatic80-blue.png,TissotSeastar1000Powermatic80-grey.png,TissotSeastar1000Powermatic80-brown.png')
            ->setPriceHt(990)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(43)
            ->setCategory('homme')
            ->setColor('blue,grey,brown')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(300)
            ->setDescription("La montre Tissot Seastar 1000 Powermatic 80 pour homme est une montre de plongée professionnelle conçue pour les plongeurs les plus exigeants. Le boîtier en acier inoxydable mesure 43 mm de diamètre et est étanche jusqu'à 300 mètres. La montre dispose d'une lunette unidirectionnelle et d'un affichage de la date à 6 heures. Le mouvement automatique Powermatic 80 assure une réserve de marche exceptionnelle de 80 heures.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Everytime')
            ->setImgUrl('TissotEverytime-green.png,TissotEverytime-red.png,TissotEverytime-yellow.png')
            ->setPriceHt(250)
            ->setMaterial('cuir')
            ->setMovement('Quartz')
            ->setCaseDiameter(38)
            ->setCategory('femme')
            ->setColor('green,red,yellow')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("La montre Tissot Everytime est une montre pour homme au design épuré et minimaliste. Le boîtier en acier inoxydable mesure 42 mm de diamètre et est associé à un bracelet en cuir élégant et confortable. La montre dispose d'un mouvement à quartz fiable et est étanche jusqu'à 30 mètres. Cette montre polyvalente convient à toutes les occasions.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Gentleman')
            ->setImgUrl('TissotGentleman-blue.png,TissotGentleman-yellow.png,TissotGentleman-pink.png')
            ->setPriceHt(800)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(36)
            ->setCategory('femme')
            ->setColor('blue,yellow,pink')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("La montre Tissot Gentleman est une montre pour femme élégante et sophistiquée. Le boîtier en acier inoxydable mesure 40 mm de diamètre et offre un design classique et intemporel. La montre dispose d'un mouvement automatique fiable et est étanche jusqu'à 100 mètres. L'affichage de la date à 3 heures ajoute une touche de praticité à l'ensemble. Le bracelet en acier inoxydable complète parfaitement le design élégant de cette montre.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Seastar 1000')
            ->setImgUrl('TissotSeastar1000-green.png,TissotSeastar1000-purple.png,TissotSeastar1000-red.png')
            ->setPriceHt(950)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(43)
            ->setCategory('femme')
            ->setColor('green,purple,red')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La montre Tissot Seastar 1000 est une montre de plongée pour femme. Le boîtier en acier inoxydable mesure 43 mm de diamètre et est équipé d'une lunette unidirectionnelle en céramique. La montre dispose d'un affichage de la date à 6 heures, d'un chronographe et est étanche jusqu'à 300 mètres. Le bracelet en acier inoxydable et céramique est à la fois résistant et élégant.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('T-Touch Expert Solar')
            ->setImgUrl('TissotTouchExpertSolar-green.png,TissotTouchExpertSolar-blue.png,TissotTouchExpertSolar-black.png')
            ->setPriceHt(1200)
            ->setMaterial('titane')
            ->setMovement('Quartz solaire')
            ->setCaseDiameter(45)
            ->setCategory('homme')
            ->setColor('green,blue,black')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La montre Tissot T-Touch Expert Solar est une montre de sport pour homme équipée de la dernière technologie. Le boîtier en titane résistant mesure 45 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose de fonctionnalités utiles pour les activités en plein air, notamment un altimètre, un baromètre, une boussole, un chronographe et un thermomètre. Le mouvement à quartz solaire assure une précision exceptionnelle et une autonomie longue durée.");
        $manager->persist($watch);
        $watches[] = $watch;

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Carson')
            ->setImgUrl('TissotCarson-gold.png,TissotCarson-green.png,TissotCarson-pink.png')
            ->setPriceHt(350)
            ->setMaterial('acier')
            ->setMovement('Quartz')
            ->setCaseDiameter(39)
            ->setCategory('femme')
            ->setColor('gold,green,pink')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("La montre Tissot Carson pour femme est une montre élégante et intemporelle. Le boîtier en acier inoxydable mesure 39 mm de diamètre et offre un design simple et épuré. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 30 mètres. Le bracelet en acier inoxydable ajoute une touche de sophistication à l'ensemble.");
        $manager->persist($watch);
        $watches[] = $watch;


        $watch = new Product();
        $watch->setBrand('Laxar')
            ->setModel('Parlin Supernova')
            ->setImgUrl('no-image.png')
            ->setPriceHt(450)
            ->setMaterial('acier')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("Découvrez la montre Parlin Supernova pour homme. Cette montre sportive automatique est conçue pour les plongeurs professionnels. Son boîtier en acier inoxydable résistant mesure 44 mm de diamètre et offre une étanchéité de 200 mètres. La lunette tournante unidirectionnelle permet de mesurer le temps de plongée avec précision. La montre dispose également d'un affichage de la date et d'un bracelet en acier inoxydable.");
        $manager->persist($watch);
        $watches[] = $watch;



        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $contact = new Contact();
            $contact->setName($faker->name());
            $contact->setLastName($faker->lastName());
            $contact->setEmail($faker->email());
            $contact->setSubject($faker->text($faker->numberBetween(5, 15)));
            $contact->setMessage($faker->text($faker->numberBetween(300, 620)));
            $contact->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $manager->persist($contact);
        }

        for ($i = 0; $i < 50; $i++) {
            $review = new Review();
            $review->setFirstname($faker->firstname());
            $review->setContent($faker->sentence(13));
            $review->setEvaluation($faker->numberBetween(1, 5));
            $review->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $review->setProduct($watches[rand(0, 26)]);
            $review->setUser($users[rand(0, 10)]);
            $manager->persist($review);
        }

        $orders = [];
        for ($i = 0; $i < 20; $i++) {
            $order = new Order();
            $order->setUser($users[rand(0, 10)])
                ->setTotal(rand(300, 1800))
                ->setStatus(rand(0, 2) == 1 ? 'Livré' : ((rand(0, 1) == 1) ? 'En cours' : 'Annulé'))
                ->setPayment(rand(0, 1) == 1 ? 'Payé' : 'non Payé')
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-15 days')));
            $orders[] = $order;
            $manager->persist($order);
        }

        for ($i = 0; $i < 50; $i++) {
            $orderItem = new OrderItems();
            $orderItem->setOrder($orders[rand(0, 19)])
                ->setProduct($watches[rand(0, 26)])
                ->setQuantity(rand(1, 2))
                ->setTotal($orderItem->getProduct()->getPriceHt() * $orderItem->getQuantity())
                ->setColor(explode(',', $orderItem->getProduct()->getColor())[0])
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-15 days')));

            $manager->persist($orderItem);
        }

        $manager->flush();
    }
}
