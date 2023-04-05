<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')

            ->setPageTitle("index", "Laxar - Administration des utilisateurs")

            ->setPaginatorPageSize(10);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
                EmailField::new('email')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('lastname')
            ->setLabel('Nom')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('firstname')
            ->setLabel('Prénom')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('number_adress')
            ->setLabel('N° de rue')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('street1')
            ->setLabel('Rue')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('street2')
            ->setLabel('Complément d\'adresse')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('postcode')
            ->setLabel('Code postal')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('city')
            ->setLabel('Ville')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('country')
            ->setLabel('Pays')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('phone_number')
            ->setLabel('Numéro de téléphone')
                ->setFormTypeOption('disabled', 'disabled'),
            DateField::new('birthday')
                ->hideOnForm()
                ->setFormTypeOption('disabled', 'disabled'),
            ArrayField::new('roles'),
            ChoiceField::new('active')
            ->setChoices([
                "oui" => 1,
                "non" => 0,
            ])


        ];
    }
}
