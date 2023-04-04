<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
        ;
    }

/*     public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('brand'),
            TextField::new('model'),
            NumberField::new('price_ht'),
            TextField::new(''),
        ];
    } */
}