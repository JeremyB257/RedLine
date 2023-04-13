<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setEntityLabelInSingular("un produit")
            ->setEntityLabelInPlural("un produits")
            ->setPageTitle("index", "Laxar - Produit")
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setDisabled('disabled', 'disabled'),
            TextField::new('brand')
                ->setLabel("Marque"),
            TextField::new('model')
                ->setLabel("Modèle"),
            TextField::new('img_url'),
            MoneyField::new('price_ht')
                ->setLabel("Prix HT")
                ->setCurrency('EUR')
                ->setStoredAsCents(),
            ChoiceField::new('material')
                ->setLabel("Matière")
                ->setChoices([
                    'acier' => 'acier',
                    'or' => 'or',
                    'titane' => 'titane',
                    'nylon' => 'nylon',
                    'cuir' => 'cuir',
                ]),
            NumberField::new('water_resistance')
                ->setLabel("Résistance à l'eau(en m)"),
            ChoiceField::new('movement')
                ->setLabel("Mouvement")
                ->setChoices([
                    'Automatique' => 'Automatique',
                    'Quartz' => 'Quartz',
                    'Quartz solaire' => 'Quartz solaire',
                    'Mecanique' => 'Mécanique'
                ]),
            NumberField::new('case_diameter')
                ->setLabel("Taille du cadran(en mm)"),
            TextEditorField::new('description')
                ->setFormType(CKEditorType::class),
            NumberField::new('stock'),
            TextField::new('slug')
                ->setLabel('Référence'),
            ChoiceField::new('category')
                ->setLabel("Categorie")
                ->setChoices([
                    'Homme' => 'homme',

                    'Femme' => 'femme',

                ]),
            TextField::new('color')
                ->setLabel('Couleur'),
            TextField::new('reduce')
                ->setLabel('Réduction'),
        ];
    }
}
