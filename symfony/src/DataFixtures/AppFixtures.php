<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Prospex')
            ->setImgUrl('no-image.png')
            ->setPriceHt(400)
            ->setMaterial('Acier inoxydable')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
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
            ->setWaterResistance(200)
            ->setDescription("Découvrez la montre Seiko Prospex Alpinist pour homme. Cette montre automatique est conçue pour les aventuriers et les amateurs d'activités de plein air. Son boîtier en acier inoxydable mesure 39,5 mm de diamètre et offre une étanchéité de 200 mètres. La montre dispose d'un affichage de la date à 3 heures et d'une boussole sur le cadran pour vous orienter lors de vos sorties en montagne. Le bracelet en cuir marron apporte une touche de rusticité à cette montre sportive.");
        $manager->persist($watch);


        $watch = new Product();
        $watch->setBrand('Seiko')
            ->setModel('Prospex Spring Drive')
            ->setImgUrl('no-image.png')
            ->setPriceHt(1200)
            ->setMaterial('Titane')
            ->setMovement('Automatique')
            ->setCaseDiameter(44)
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
            ->setWaterResistance(50)
            ->setDescription("La montre Seiko Presage pour homme est une montre élégante et fonctionnelle. Son boîtier en acier inoxydable mesure 40,5 mm de diamètre et son cadran bleu soleillé est orné de sous-cadrans pour le chronographe. La montre dispose d'une fonction chronographe pour mesurer le temps écoulé et d'un affichage de la date à 4 heures. La montre est étanche jusqu'à 50 mètres et dispose d'un bracelet en cuir noir. La montre Seiko Presage est un choix parfait pour les hommes élégants qui ont besoin d'une montre polyvalente pour leur vie quotidienne.");
        $manager->persist($watch);
        $manager->flush();
    }
}
