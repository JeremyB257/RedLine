<?php

namespace App\DataFixtures;

use App\Entity\Product;
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
        $user->setRoles(['ROLE_ADMIN']);
        $user->setNewsletter(true);
        $manager->persist($user);

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++){
            $user = new User();
            $user->setFirstname($faker->firstname());
            $user->setEmail($faker->safeEmail());
            $user->setPassword($this->hasher->hashPassword($user, $faker->password()));
            $user->setNewsletter(true);
            $manager->persist($user);
        }

        $slugger = new AsciiSlugger();

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Prospex')
            ->setImgUrl('no-image.png')
            ->setPriceHt(400)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription('Découvrez la montre Seiko Prospex pour homme. Cette montre sportive automatique est conçue pour les plongeurs professionnels. Son boîtier en acier inoxydable résistant mesure 44 mm de diamètre et offre une étanchéité de 200 mètres. La lunette tournante unidirectionnelle permet de mesurer le temps de plongée avec précision. La montre dispose également d\'un affichage de la date et d\'un bracelet en acier inoxydable.');
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Presage')
            ->setImgUrl('no-image.png')
            ->setPriceHt(900)
            ->setMaterial('Cuir')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(50)
            ->setDescription('La montre Seiko Presage pour homme est une montre automatique élégante et raffinée. Son boîtier en acier inoxydable mesure 40,5 mm de diamètre et son bracelet en cuir noir apporte une touche de sophistication. La montre dispose d\'un affichage de la date à 3 heures et est étanche jusqu\'à 50 mètres. La montre Presage est un choix parfait pour les occasions formelles et les événements spéciaux.');
        $manager->persist($watch);



        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('5 Sports')
            ->setImgUrl('no-image.png')
            ->setPriceHt(200)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(42)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription('Découvrez la montre Seiko 5 Sports pour homme. Cette montre automatique est conçue pour les activités sportives et de plein air. Son boîtier en acier inoxydable mesure 42,5 mm de diamètre et offre une étanchéité de 100 mètres. La lunette tournante unidirectionnelle permet de mesurer le temps écoulé avec précision. La montre dispose également d\'un affichage de la date et d\'un bracelet en acier inoxydable. La montre Seiko 5 Sports est un choix parfait pour les aventuriers et les sportifs.');
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Prospex Diver')
            ->setImgUrl('no-image.png')
            ->setPriceHt(300)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(42)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La montre Seiko Prospex Diver pour homme est une montre automatique conçue pour les plongeurs. Son boîtier en acier inoxydable mesure 42 mm de diamètre et offre une étanchéité de 200 mètres. La montre dispose d'une lunette tournante unidirectionnelle pour mesurer le temps de plongée et d'un affichage de la date à 3 heures. Le bracelet en caoutchouc noir assure un bon maintien sur le poignet, même sous l'eau.");
        $manager->persist($watch);



        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Astron')
            ->setImgUrl('no-image.png')
            ->setPriceHt(2200)
            ->setMaterial('Titane')
            ->setMovement('Quartz solaire')
            ->setCaseDiameter(43)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La montre Seiko Astron pour homme est une montre GPS solaire haut de gamme. Son boîtier en titane mesure 42,9 mm de diamètre et offre une étanchéité de 100 mètres. La montre est alimentée par l'énergie solaire et dispose d'une fonction GPS qui permet de régler automatiquement l'heure et la date en fonction de votre position géographique. La montre dispose également d'un affichage de la date et d'un bracelet en titane.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Presage Cocktail Time')
            ->setImgUrl('no-image.png')
            ->setPriceHt(500)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(50)
            ->setDescription("La montre Seiko Presage Cocktail Time pour homme est une montre élégante et raffinée conçue pour les amateurs de cocktails. Son boîtier en acier inoxydable mesure 40,5 mm de diamètre et son cadran vert bouteille est orné d'un motif de soleil rayonnant. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 50 mètres. La montre Presage Cocktail Time est un choix parfait pour les soirées chics et les dîners entre amis.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Prospex Alpinist')
            ->setImgUrl('no-image.png')
            ->setPriceHt(750)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("Découvrez la montre Seiko Prospex Alpinist pour homme. Cette montre automatique est conçue pour les aventuriers et les amateurs d'activités de plein air. Son boîtier en acier inoxydable mesure 40 mm de diamètre et offre une étanchéité de 200 mètres. La montre dispose d'un affichage de la date à 3 heures et d'une boussole sur le cadran pour vous orienter lors de vos sorties en montagne. Le bracelet en cuir marron apporte une touche de rusticité à cette montre sportive.");
        $manager->persist($watch);


        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Prospex Spring Drive')
            ->setImgUrl('no-image.png')
            ->setPriceHt(1200)
            ->setMaterial('Titane')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(300)
            ->setDescription("La montre Seiko Prospex pour homme est une montre de plongée haut de gamme. Son boîtier en titane mesure 44 mm de diamètre et offre une étanchéité de 300 mètres. La montre est équipée d'un mouvement automatique et dispose d'une fonction GMT pour afficher un second fuseau horaire. La date est affichée à 3 heures. Le bracelet en titane est confortable à porter, même lors de plongées prolongées. La montre Seiko Prospex est un choix parfait pour les plongeurs expérimentés et les amateurs de montres robustes.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Prospex Samurai')
            ->setImgUrl('no-image.png')
            ->setPriceHt(500)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La montre Seiko Prospex Samurai pour homme est une montre automatique conçue pour les plongeurs. Son boîtier en acier inoxydable mesure 44 mm de diamètre et offre une étanchéité de 200 mètres. La montre dispose d'une lunette tournante unidirectionnelle pour mesurer le temps de plongée et d'un affichage de la date à 3 heures. Le bracelet en acier inoxydable assure un look robuste et sportif.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Presage Chrono')
            ->setImgUrl('no-image.png')
            ->setPriceHt(800)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(41)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(50)
            ->setDescription("La montre Seiko Presage pour homme est une montre élégante et fonctionnelle. Son boîtier en acier inoxydable mesure 40,5 mm de diamètre et son cadran bleu soleillé est orné de sous-cadrans pour le chronographe. La montre dispose d'une fonction chronographe pour mesurer le temps écoulé et d'un affichage de la date à 4 heures. La montre est étanche jusqu'à 50 mètres et dispose d'un bracelet en cuir noir. La montre Seiko Presage est un choix parfait pour les hommes élégants qui ont besoin d'une montre polyvalente pour leur vie quotidienne.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Le Locle')
            ->setImgUrl('no-image.png')
            ->setPriceHt(700)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(39)
            ->setCategory('femme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("Découvrez la montre Tissot Le Locle pour homme. Cette montre automatique est un hommage à la ville suisse du même nom, berceau de l'horlogerie Tissot. Le boîtier en acier inoxydable mesure 39 mm de diamètre et offre un design élégant et classique. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 30 mètres. Le bracelet en acier inoxydable complète parfaitement l'ensemble.");
        $manager->persist($watch);


        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('T-Touch Expert Solar')
            ->setImgUrl('no-image.png')
            ->setPriceHt(1200)
            ->setMaterial('Titane')
            ->setMovement('Quartz solaire')
            ->setCaseDiameter(45)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La montre Tissot T-Touch Expert Solar est une montre de sport pour homme équipée de la dernière technologie. Le boîtier en titane résistant mesure 45 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose de fonctionnalités utiles pour les activités en plein air, notamment un altimètre, un baromètre, une boussole, un chronographe et un thermomètre. Le mouvement à quartz solaire assure une précision exceptionnelle et une autonomie longue durée.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Carson')
            ->setImgUrl('no-image.png')
            ->setPriceHt(350)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Quartz')
            ->setCaseDiameter(39)
            ->setCategory('femme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("La montre Tissot Carson pour homme est une montre élégante et intemporelle. Le boîtier en acier inoxydable mesure 40 mm de diamètre et offre un design simple et épuré. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 30 mètres. Le bracelet en acier inoxydable ajoute une touche de sophistication à l'ensemble.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('V8')
            ->setImgUrl('no-image.png')
            ->setPriceHt(550)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Quartz')
            ->setCaseDiameter(42)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La montre Tissot V8 pour homme est une montre sportive et élégante. Le boîtier en acier inoxydable mesure 42,5 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose d'un chronographe et d'un affichage de la date à 4 heures. Le bracelet en acier inoxydable ajoute une touche de sophistication à l'ensemble.");
        $manager->persist($watch);


        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Heritage Visodate')
            ->setImgUrl('no-image.png')
            ->setPriceHt(580)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(41)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(30)
            ->setDescription("La montre Tissot Heritage Visodate pour homme est un hommage aux montres Tissot classiques du passé. Le boîtier en acier inoxydable mesure 40 mm de diamètre et offre un design élégant et intemporel. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 30 mètres. Le bracelet en acier inoxydable complète parfaitement l'ensemble.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Seastar 1000 Powermatic 80')
            ->setImgUrl('no-image.png')
            ->setPriceHt(990)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(43)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(300)
            ->setDescription("La montre Tissot Seastar 1000 Powermatic 80 pour homme est une montre de plongée professionnelle conçue pour les plongeurs les plus exigeants. Le boîtier en acier inoxydable mesure 43 mm de diamètre et est étanche jusqu'à 300 mètres. La montre dispose d'une lunette unidirectionnelle et d'un affichage de la date à 6 heures. Le mouvement automatique Powermatic 80 assure une réserve de marche exceptionnelle de 80 heures.");
        $manager->persist($watch);


        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Everytime')
            ->setImgUrl('no-image.png')
            ->setPriceHt(250)
            ->setMaterial('Cuir')
            ->setMovement('Quartz')
            ->setCaseDiameter(38)
            ->setCategory('femme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("La montre Tissot Everytime est une montre pour homme au design épuré et minimaliste. Le boîtier en acier inoxydable mesure 42 mm de diamètre et est associé à un bracelet en cuir élégant et confortable. La montre dispose d'un mouvement à quartz fiable et est étanche jusqu'à 30 mètres. Cette montre polyvalente convient à toutes les occasions.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Gentleman')
            ->setImgUrl('no-image.png')
            ->setPriceHt(800)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("La montre Tissot Gentleman est une montre pour homme élégante et sophistiquée. Le boîtier en acier inoxydable mesure 40 mm de diamètre et offre un design classique et intemporel. La montre dispose d'un mouvement automatique fiable et est étanche jusqu'à 100 mètres. L'affichage de la date à 3 heures ajoute une touche de praticité à l'ensemble. Le bracelet en acier inoxydable complète parfaitement le design élégant de cette montre.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Tissot')
            ->setModel('Seastar 1000')
            ->setImgUrl('no-image.png')
            ->setPriceHt(950)
            ->setMaterial('Acier inoxydable et céramique')
            ->setMovement('Automatique')
            ->setCaseDiameter(43)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La montre Tissot Seastar 1000 est une montre de plongée pour homme. Le boîtier en acier inoxydable mesure 43 mm de diamètre et est équipé d'une lunette unidirectionnelle en céramique. La montre dispose d'un affichage de la date à 6 heures, d'un chronographe et est étanche jusqu'à 300 mètres. Le bracelet en acier inoxydable et céramique est à la fois résistant et élégant.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Submariner')
            ->setImgUrl('no-image.png')
            ->setPriceHt(8500)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(41)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La Rolex Submariner est une montre de plongée emblématique pour homme. Le boîtier en acier inoxydable mesure 41 mm de diamètre et est équipé d'une lunette tournante unidirectionnelle. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 300 mètres. Le bracelet en acier inoxydable est à la fois robuste et élégant.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('GMT-Master II')
            ->setImgUrl('no-image.png')
            ->setPriceHt(12000)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La Rolex GMT-Master II est une montre pour homme conçue pour les voyageurs. Le boîtier en acier inoxydable mesure 40 mm de diamètre et est équipé d'une lunette bidirectionnelle en céramique. La montre dispose d'un affichage de l'heure GMT et d'un affichage de la date à 3 heures. Elle est étanche jusqu'à 100 mètres et dispose d'un bracelet en acier inoxydable confortable.");
        $manager->persist($watch);


        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Datejust')
            ->setImgUrl('no-image.png')
            ->setPriceHt(9500)
            ->setMaterial('Acier inoxydable et Or jaune')
            ->setMovement('Automatique')
            ->setCaseDiameter(41)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La Rolex Datejust pour homme est une montre élégante et intemporelle. Le boîtier en acier inoxydable et or jaune mesure 41 mm de diamètre et offre un design classique. La montre dispose d'un affichage de la date à 3 heures et est étanche jusqu'à 100 mètres. Le bracelet en acier inoxydable et or jaune ajoute une touche de sophistication à l'ensemble.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Daytona')
            ->setImgUrl('no-image.png')
            ->setPriceHt(13000)
            ->setMaterial('Or jaune 18 carats')
            ->setMovement('Automatique')
            ->setCaseDiameter(40)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La Rolex Daytona est une montre de sport de luxe pour homme. Le boîtier en or jaune 18 carats mesure 40 mm de diamètre et offre un design élégant et classique. La montre dispose d'un chronographe et est étanche jusqu'à 100 mètres. Le bracelet en or jaune 18 carats complète parfaitement l'ensemble.");
        $manager->persist($watch);


        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Explorer')
            ->setImgUrl('no-image.png')
            ->setPriceHt(6600)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(39)
            ->setCategory('femme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(0)
            ->setDescription("La Rolex Explorer est une montre de sport pour homme. Le boîtier en acier inoxydable mesure 39 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose d'un affichage de la date à 3 heures et d'aiguilles luminescentes pour une visibilité accrue dans l'obscurité. Le bracelet en acier inoxydable est à la fois robuste et élégant.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Day-Date')
            ->setImgUrl('no-image.png')
            ->setPriceHt(33500)
            ->setMaterial('Or jaune 18 carats')
            ->setMovement('Automatique')
            ->setCaseDiameter(36)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(100)
            ->setDescription("La Rolex Day-Date est une montre de luxe pour homme en or jaune 18 carats. Le boîtier mesure 36 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose d'un affichage de la date à 3 heures et d'un affichage du jour de la semaine en toutes lettres à 12 heures. Le bracelet en or jaune 18 carats est à la fois élégant et confortable.");
        $manager->persist($watch);

        $watch = new Product();
        $watch->setBrand('Rolex')
            ->setModel('Air-King')
            ->setImgUrl('no-image.png')
            ->setPriceHt(6100)
            ->setMaterial('Acier Oystersteel')
            ->setMovement('Automatique')
            ->setCaseDiameter(42)
            ->setCategory('homme')
            ->setColor('white')
            ->setStock(rand(0, 50))
            ->setSlug($slugger->slug($watch->getModel()))
            ->setWaterResistance(200)
            ->setDescription("La Rolex Air-King est une montre pour homme inspirée par les pionniers de l'aviation. Le boîtier en acier Oystersteel mesure 40 mm de diamètre et est étanche jusqu'à 100 mètres. La montre dispose d'un design épuré et élégant, sans fonctionnalités spécifiques. Le mouvement automatique offre une grande précision et une autonomie longue durée.");
        $manager->persist($watch);

        $manager->flush();
    }
}
