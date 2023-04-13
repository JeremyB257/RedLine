<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setEntityLabelInSingular("Commande")
            ->setEntityLabelInPlural("Commandes")
            ->setPageTitle("index", "Laxar - Commandes")
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setDisabled('disabled', 'disabled'),
            AssociationField::new('user'),
            MoneyField::new('reduce')
                ->setLabel("Reduction")
                ->setCurrency('EUR')
                ->setDisabled('disabled', 'disabled')
                ->setStoredAsCents(),
            MoneyField::new('Total')
                ->setLabel("Total")
                ->setCurrency('EUR')
                ->setDisabled('disabled', 'disabled')
                ->setStoredAsCents(),
            TextField::new('Status'),
            TextField::new('payment'),
            DateField::new('createdAt')
                ->setLabel('Date de commande'),
        ];
    }
}
