<?php

namespace App\Controller\Admin;

use App\Entity\Reduce;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReduceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reduce::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle("index", "Laxar - Réduction")
            ->setEntityLabelInSingular("une réduction");
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('dateStart')
                ->setLabel('Date de début'),
            DateField::new('dateEnd')
                ->setLabel('Date de fin'),
            ChoiceField::new('type')
                ->setChoices([
                    '%' => '%',
                    '€' => '€',
                ]),
            TextField::new('code'),
            NumberField::new('value')
                ->setLabel('Valeur'),
            ChoiceField::new('active')
                ->setChoices([
                    'oui' => 1,
                    'non' => 0,
                ]),

        ];
    }
}
