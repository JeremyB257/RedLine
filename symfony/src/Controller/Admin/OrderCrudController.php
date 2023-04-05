<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->setDisabled('disabled', 'disabled'),
            IdField::new('user_id'),
            TextField::new('Reduce')
            ->setLabel('Réduction'),
            NumberField::new('Total')
            ->setDisabled('disabled', 'disabled'),
            TextField::new('Status'),
            TextField::new('Payement'),
            DateField::new('createdAt')
            ->setLabel('Date de commande'),
            
        ];
    }

}
